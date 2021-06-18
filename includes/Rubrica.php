<?php
include __DIR__ . '/FormHandle.php';
class Rubrica extends FormHandle
{
    protected static function sanitize($fields)
    {
        $fields['nome'] = self::clean_input($fields['nome']);
        // Sanificare numero di telefono e verificarne la validità
        $fields['telefono'] = self::clean_input($fields['telefono']);
        if (self::is_phone_number_valid($fields['telefono']) === 0) {
            var_dump("Numero di telefono non valido.");
            return false;
            // TODO: gestire errore.
        } else if (self::is_phone_number_valid($fields['telefono']) === false) {
            var_dump("C'è un errore nella regex 😓");
            // TODO: gestire errore.
            return false;

        }

        // Sanificare organizzazione
        if (isset($fields['organizzazione']) && $fields['organizzazione'] !== '') {
            $fields['organizzazione'] = self::clean_input($fields['organizzazione']);
        }

        // Sanificare email e verificarne la validità
        if (isset($fields['email']) && $fields['email'] !== '') {
            $fields['email'] = self::clean_input($fields['email']);
            if (!self::is_email_address_valid($fields['email'])) {
                var_dump("Indirizzo email non valido.");
                // TODO: gestire errore.
                return false;

            }
        }

        // Sanificare indirizzo
        if (isset($fields['indirizzo']) && $fields['indirizzo'] !== '') {
            $fields['indirizzo'] = self::clean_input($fields['indirizzo']);
        }

        // Sanificare compleanno e verificare che sia una data.
        if (isset($fields['compleanno']) && $fields['compleanno'] !== '') {
            $fields['compleanno'] = self::clean_input($fields['compleanno']);
            if (strtotime($fields['compleanno'])) {
                // Converte la data nel formato previsto da MySQL.
                $fields['compleanno'] = date('Y-m-d', strtotime(str_replace('-', '/', $fields['compleanno'])));
            } else {
                var_dump("Data di compleanno non valida.");
                // TODO: gestire errore.
                return false;

            }
        }

        return $fields;
    }

    public static function insert_data($form_data)
    {

        $fields = array(
            'nome' => $form_data['nome'],
            'telefono' => $form_data['telefono'],
            'organizzazione' => $form_data['organizzazione'],
            'email' => $form_data['email'],
            'indirizzo' => $form_data['indirizzo'],
            'compleanno' => $form_data['compleanno'],
        );

        $fields = self::sanitize($fields);

        if ($fields) {
            $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "rubricadb");

            if ($mysqli->connect_errno) {
                echo "Connessione al database fallita: " . $mysqli->connect_error;
                exit();
            }

            $query = $mysqli->prepare("INSERT INTO contatti(Nome, Telefono) VALUES (?, ?)");
            $query->bind_param('ss', $fields['nome'], $fields['telefono']);
            $query->execute();

            if ($query->affected_rows === 0) {
                var_dump("Errore in inserimento, controlla il log.");
                // TODO: gestire errore.
                return false;
            }

            $last_id = $query->insert_id;

            $query_2 = $mysqli->prepare("INSERT INTO contatti_meta(contatti_id, organizzazione, email, indirizzo, compleanno) VALUES (?, ?, ?, ?, ?)");
            $org = ($fields['organizzazione'] !== '') ? $fields['organizzazione'] : null;
            $email = ($fields['email'] !== '') ? $fields['email'] : null;
            $indirizzo = ($fields['indirizzo'] !== '') ? $fields['indirizzo'] : null;
            $compleanno = ($fields['compleanno'] !== '') ? $fields['compleanno'] : null;
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

    public static function select_data($args = null)
    {
        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "rubricadb");

        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

        if (isset($args['id'])) {
            $args['id'] = intval($args['id']);
            $query = $mysqli->prepare("SELECT contatti.ID, Nome, Telefono, organizzazione, email, indirizzo, compleanno FROM contatti JOIN contatti_meta ON contatti.ID=contatti_meta.contatti_id WHERE contatti.ID = ?");
            $query->bind_param('i', $args['id']);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $mysqli->query("SELECT * FROM contatti");
        }

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;

    }

    public static function delete_data($id)
    {
        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "rubricadb");

        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

        $id = intval($id);

        $query = $mysqli->prepare("DELETE FROM contatti_meta WHERE contatti_id = ?");
        $query->bind_param('i', $id);
        $query->execute();

        $query = $mysqli->prepare("DELETE FROM contatti WHERE ID = ?");
        $query->bind_param('i', $id);
        $query->execute();

        if ($query->affected_rows > 0) {
            header('Location: http://localhost:8888/rubrica/?statocanc=ok');
            exit;
        } else {
            header('Location: http://localhost:8888/rubrica/?statocanc=ko');
            exit;
        }

    }

    public static function update_data($form_data, $id)
    {

        $fields = array(
            'nome' => $form_data['nome'],
            'telefono' => $form_data['telefono'],
            'organizzazione' => $form_data['organizzazione'],
            'email' => $form_data['email'],
            'indirizzo' => $form_data['indirizzo'],
            'compleanno' => $form_data['compleanno'],
        );

        $fields = self::sanitize($fields);

        if ($fields) {
            $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "rubricadb");

            if ($mysqli->connect_errno) {
                echo "Connessione al database fallita: " . $mysqli->connect_error;
                exit();
            }

            $id = intval($id);

            $query = $mysqli->prepare("UPDATE contatti SET Nome = ?, Telefono = ? WHERE ID = ?");
            $query->bind_param('ssi', $fields['nome'], $fields['telefono'], $id);
            $query->execute();

            if (count($query->error_list) > 0) {
                var_dump("Errore in inserimento, controlla il log.");
                // TODO: gestire errore.
                return false;
            }

            $query_2 = $mysqli->prepare("UPDATE contatti_meta SET organizzazione = ?, email = ?, indirizzo = ?, compleanno = ? WHERE contatti_id = ?");
            $org = ($fields['organizzazione'] !== '') ? $fields['organizzazione'] : null;
            $email = ($fields['email'] !== '') ? $fields['email'] : null;
            $indirizzo = ($fields['indirizzo'] !== '') ? $fields['indirizzo'] : null;
            $compleanno = ($fields['compleanno'] !== '') ? $fields['compleanno'] : null;
            $query_2->bind_param('ssssi', $org, $email, $indirizzo, $compleanno, $id);
            $query_2->execute();

            if (count($query_2->error_list) > 0) {
                header('Location: http://localhost:8888/rubrica/modifica-contatto.php?stato=ko&id=' . $id);
                exit;
            }

            header('Location: http://localhost:8888/rubrica/modifica-contatto.php?id=' . $id . '&stato=ok');
            exit;
        }
    }
}