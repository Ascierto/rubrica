<?php
namespace DataFather;

abstract class FormHandle
{
    abstract protected static function sanitize($fields);
    abstract public static function insertData($form_data);
    abstract public static function selectData($args = null);
    abstract public static function deleteData($id);
    abstract public static function updateData($form_data, $id);
    public static function cleanInput($data)
    {
        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_ADD_SLASHES);
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $data;
    }
    public static function isPhoneNumberValid($phone_number)
    {
        return preg_match('/^([\+][0-9]{2,3})?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone_number);
    }
    public static function isEmailAddressValid($email_address)
    {
        // return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i', $email_address);
        return filter_var($email_address, FILTER_VALIDATE_EMAIL);
    }
}
