<?php

/* this file was reverse-engineered from http://www.iprogrammerindia.in/enable-image-upload-option-in-ckeditor-using-php/
 *
 * there's complete and functioning code at that link, but I used it only as a reference to understand what all goes
 * into integrating CKEditor with CodeIgniter projects (without using a helper or CKFinder).
 */

$CKEditorFuncNum;
$destination;
$url;
$message;
$file_name;
$extension;

$file_name = md5(uniqid(mt_rand()));
$extension = end((explode(".", $_FILES['upload']['name'])));
$destination = 'uploads/' . $file_name . '.' . $extension;

$url = base_url($destination);

$move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $destination );

if( !$move ){
  $message = "File could not be uploaded.";
}

$CKEditorFuncNum = $_GET['CKEditorFuncNum'];
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message');</script>";
