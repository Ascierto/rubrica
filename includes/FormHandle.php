
<?php
abstract class FormHandle
{
    abstract protected static function sanitize($fields);
    abstract public static function insert_data($form_data);
    abstract public static function select_data($args = null);
    abstract public static function delete_data($id);
    abstract public static function update_data($form_data, $id);
    public static function clean_input($data)
    {
        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_ADD_SLASHES);
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $data;
    }
    public static function is_phone_number_valid($phone_number)
    {
        return preg_match('/^([\+][0-9]{2,3})?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone_number);
    }
    public static function is_email_address_valid($email_address)
    {
        // return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i', $email_address);
        return filter_var($email_address, FILTER_VALIDATE_EMAIL);
    }
}




    //regex telefono  ^([\+][0-9]{2,3})?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$

    // regex email /^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/


//     $email = "abc123@sdsd.com"; 
// $regex = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/'; 
// if (preg_match($regex, $email)) {
//  echo $email . " is a valid email. We can accept it.";
// } else { 
//  echo $email . " is an invalid email. Please try again.";
// }   



