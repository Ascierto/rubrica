<?php
namespace DataHandling;

use \DataHandling\Utils\InputSanitize;
use Mysqli;

class Rubrica extends FormHandle
{

    protected static function sanitize($fields)
    {
         $errors        = array();
        $fields['nome'] = self::cleanInput($fields['nome']);
        // Sanificare numero di telefono e verificarne la validità
        $fields['telefono'] = self::cleanInput($fields['telefono']);
        if (self::isPhoneNumberValid($fields['telefono']) === 0) {
            $errors[] = new \Exception('Numero di telefono non valido.');
        }

        // Sanificare organizzazione
        if (isset($fields['organizzazione']) && $fields['organizzazione'] !== '') {
            $fields['organizzazione'] = self::cleanInput($fields['organizzazione']);
        }

        // Sanificare email e verificarne la validità
        if (isset($fields['email']) && $fields['email'] !== '') {
            $fields['email'] = self::cleanInput($fields['email']);
            if (! self::isEmailAddressValid($fields['email'])) {
                $errors[] = new \Exception('Indirizzo email non valido.');
            }
        }

        // Sanificare indirizzo
        if (isset($fields['indirizzo']) && $fields['indirizzo'] !== '') {
            $fields['indirizzo'] = self::cleanInput($fields['indirizzo']);
        }

        // Sanificare compleanno e verificare che sia una data.
        if (isset($fields['compleanno']) && $fields['compleanno'] !== '') {
            $fields['compleanno'] = self::cleanInput($fields['compleanno']);
            if (strtotime($fields['compleanno'])) {
                // Converte la data nel formato previsto da MySQL.
                $fields['compleanno'] = date('Y-m-d', strtotime(str_replace('-', '/', $fields['compleanno'])));
            } else {
                $errors[] = new \Exception('Data di compleanno non valida.');
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return $fields;
    }

    public static function insertData($form_data, $loggedInUserId)
    {
        $fields = array(
            'nome'           => $form_data['nome'],
            'telefono'       => $form_data['telefono'],
            'organizzazione' => $form_data['organizzazione'],
            'email'          => $form_data['email'],
            'indirizzo'      => $form_data['indirizzo'],
            'compleanno'     => $form_data['compleanno'],
        );

        $fields = self::sanitize($fields);

        if ($fields[0] instanceof \Exception) {
            $error_messages = '';
            foreach ($fields as $key => $error) {
                $error_messages .= $error->getMessage();
                if ($key < count($fields) - 1) {
                    $error_messages .= '|';
                }
            }
            header('Location: http://localhost:8888/rubrica/inserisci-contatto.php?stato=errore&messages='
             . $error_messages);
            exit;
        }

        if ($fields) {
            $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'rubricadb');

            if ($mysqli->connect_errno) {
                echo 'Connessione al database fallita: ' . $mysqli->connect_error;
                exit();
            }

            $query = $mysqli->prepare('INSERT INTO contatti(Nome, Telefono, id_utente) VALUES (?, ?, ?)');
            $query->bind_param('ssi', $fields['nome'], $fields['telefono'], $loggedInUserId);
            $query->execute();

            if ($query->affected_rows === 0) {
                error_log('Errore MySQL: ' . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/rubrica/inserisci-contatto.php?stato=ko');
                exit;
            }

            $last_id = $query->insert_id;

            $query->close();

            $query_2    = $mysqli->prepare('INSERT INTO
            contatti_meta(contatti_id, organizzazione, email, indirizzo, compleanno)
            VALUES (?, ?, ?, ?, ?)');
            $org        = ( $fields['organizzazione'] !== '' ) ? $fields['organizzazione'] : null;
            $email      = ( $fields['email'] !== '' ) ? $fields['email'] : null;
            $indirizzo  = ( $fields['indirizzo'] !== '' ) ? $fields['indirizzo'] : null;
            $compleanno = ( $fields['compleanno'] !== '' ) ? $fields['compleanno'] : null;
            $query_2->bind_param('issss', $last_id, $org, $email, $indirizzo, $compleanno);
            $query_2->execute();

            if ($query_2->affected_rows === 0) {
                header('Location: http://localhost:8888/rubrica/inserisci-contatto.php?stato=ko');
                exit;
            }

            header('Location: http://localhost:8888/rubrica/inserisci-contatto.php?stato=ok');
            exit;
        }
    }

    public static function selectData($args = null)
    {
        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'rubricadb');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

        if (isset($args['id'])) {
            $args['id'] = intval($args['id']);
            $query      = $mysqli->prepare('SELECT contatti.ID, Nome, Telefono, organizzazione, email,
            indirizzo, compleanno FROM contatti JOIN contatti_meta ON contatti.ID=contatti_meta.contatti_id
            WHERE contatti.ID = ? AND contatti.id_utente = ?');
            $query->bind_param('ii', $args['id'], $args['userId']);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $mysqli->query('SELECT * FROM contatti WHERE id_utente = ' . $args['userId']);
        }

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

    public static function deleteData($id = null, $userId = null)
    {
      $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'rubricadb');

      if ($mysqli->connect_errno) {
          echo 'Connessione al database fallita: ' . $mysqli->connect_error;
          exit();
      }

      if ( $id ) {

        $id = intval($id);

        $query = $mysqli->prepare('DELETE FROM contatti WHERE ID = ?');
        $query->bind_param('i', $id);
        $query->execute();

        if ($query->affected_rows > 0) {
            header('Location: http://localhost:8888/rubrica/?statocanc=ok');
            exit;
        } else {
            header('Location: http://localhost:8888/rubrica/?statocanc=ko');
            exit;
        }
      } else {
        // $query = $mysqli->query('DELETE FROM contatti_meta');
        $query = $mysqli->prepare('DELETE FROM contatti WHERE id_utente = ?');
        $query->bind_param('i', $userId);
        $query->execute();

        if ($query->affected_rows > 0) {
            header('Location: http://localhost:8888/rubrica/admin.php?statocanc=ok');
            exit;
        } else {
            header('Location: http://localhost:8888/rubrica/admin.php?statocanc=ko');
            exit;
        }
      }
    }

    public static function updateData($form_data, $id)
    {
        $fields = array(
            'nome'           => $form_data['nome'],
            'telefono'       => $form_data['telefono'],
            'organizzazione' => $form_data['organizzazione'],
            'email'          => $form_data['email'],
            'indirizzo'      => $form_data['indirizzo'],
            'compleanno'     => $form_data['compleanno'],
        );

        $fields = self::sanitize($fields);

        if ($fields) {
            $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'rubricadb');

            if ($mysqli->connect_errno) {
                echo 'Connessione al database fallita: ' . $mysqli->connect_error;
                exit();
            }

            $id          = intval($id);
            $is_in_error = false;

            try {
                $query = $mysqli->prepare('UPDATE contatti SET Nome = ?, Telefono = ? WHERE ID = ?');
                if (is_bool($query)) {
                    $is_in_error = true;
                    throw new \Exception('Query non valida. $mysqli->prepare ha restituito false.');
                }
                $query->bind_param('ssi', $fields['nome'], $fields['telefono'], $id);
                $query->execute();
            } catch (\Exception $e) {
                error_log("Errore PHP in linea {$e->getLine()}: " . $e->getMessage() . "\n", 3, 'my-errors.log');
            }

            if (! is_bool($query)) {
                if (count($query->error_list) > 0) {
                    $is_in_error = true;
                    foreach ($query->error_list as $error) {
                        error_log("Errore MySQL n. {$error['errno']}: {$error['error']} \n", 3, 'my-errors.log');
                    }
                    header('Location: http://localhost:8888/rubrica/modifica-contatto.php?id=' . $id . '&stato=ko');
                    exit;
                }
                try {
                    $query_2 = $mysqli->prepare('UPDATE contatti_meta
                    SET organizzazione = ?, email = ?, indirizzo = ?, compleanno = ?
                    WHERE contatti_id = ?');
                    if (is_bool($query_2)) {
                        $is_in_error = true;
                        throw new \Exception("Query non valida. $mysqli->prepare ha restituito false.");
                    }
                    $org        = ( $fields['organizzazione'] !== '' ) ? $fields['organizzazione'] : null;
                    $email      = ( $fields['email'] !== '' ) ? $fields['email'] : null;
                    $indirizzo  = ( $fields['indirizzo'] !== '' ) ? $fields['indirizzo'] : null;
                    $compleanno = ( $fields['compleanno'] !== '' ) ? $fields['compleanno'] : null;
                    $query_2->bind_param('ssssi', $org, $email, $indirizzo, $compleanno, $id);
                    $query_2->execute();
                } catch (\Exception $e) {
                    error_log('Errore PHP: ' . $e->getMessage() . "\n", 3, 'my-errors.log');
                }

                if (count($query_2->error_list) > 0) {
                    $is_in_error = true;
                    foreach ($query_2->error_list as $error) {
                        error_log("Errore MySQL n. {$error['errno']}: {$error['error']} \n", 3, 'my-errors.log');
                    }

                    header('Location: http://localhost:8888/rubrica/modifica-contatto.php?stato=ko&id=' . $id);
                    exit;
                }
            }

            $stato = $is_in_error ? 'ko' : 'ok';
            header('Location: http://localhost:8888/rubrica/modifica-contatto.php?id=' . $id . '&stato=' . $stato);
            exit;
        }
    }
}