<?php
function get_table_head($assoc_array)
{

    $keys = array_keys($assoc_array);
    $html = '';

    foreach ($keys as $key) {
        $html .= '<th>' . ucwords($key) . '</th>';
    }

    return $html;
}

function get_table_body($items)
{

    $html = '';

    foreach ($items as $row) {
        $html .= '<tr class="table-secondary">';
        foreach ($row as $key => $value) {
            if ($key === "Nome") {
                if (isset($_GET['id'])) {
                    $html .= "<td>$value</td>";
                } else {
                    $html .= "<td><a href='/rubrica/dettaglio-contatto.php?id={$row['Id']}' class='text-decoration-none text-success'>$value</a></td>";
                }
            } else if ($key === "Telefono") {
                $html .= "<td><a href='tel:$value' class='text-decoration-none text-info'>$value</a></td>";
            } else {
                $html .= "<td>$value</td>";
            }
        }
        if (!isset($_GET['id'])) {
            $html .= '<td><a href="/rubrica/includes/cancella-contatto.php?id=' . $row['Id'] . '" class="text-decoration-none">❌</a></td>';
            $html .= '<td><a href="/rubrica/modifica-contatto.php?id=' . $row['Id'] . '" class="text-decoration-none">✏</a></td>';
        }
        $html .= '</tr>';
    }

    return $html;

}