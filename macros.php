<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

/*
|--------------------------------------------------------------------------
| Standard fields
|--------------------------------------------------------------------------
*/
/*
 * Add an input field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('arrayInput', function ($name, $title, ViewErrorBag $errors, $object = null, array $options = []) {

    $error_name = str_replace('[', '.', $name);
    $error_name = str_replace(']', '', $error_name);

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title], $options);

    $string = "<div class='form-group " . ($errors->has($error_name) ? ' has-error' : '') . "'>";
    $string .= Form::label($name, $title);

    if (is_object($object)) {
        $objName = explode('[', str_replace(']', '', $name));
        $currentData = isset($object->{$objName[0]}->{$objName[1]}) ? $object->{$objName[0]}->{$objName[1]} : '';
    } else {
        $currentData = null;
    }

    $string .= Form::text($name, old($name, $currentData), $options);
    $string .= $errors->first($error_name, '<span class="help-block">:message</span>');
    $string .= '</div>';

    return new HtmlString($string);
});


Form::macro('arrayTextarea', function ($name, $title, ViewErrorBag $errors, $object = null, array $options = []) {

    $error_name = str_replace('[', '.', $name);
    $error_name = str_replace(']', '', $error_name);

    $options = array_merge(['class' => 'ckeditor', 'rows' => 10, 'cols' => 10], $options);

    $string = "<div class='form-group " . ($errors->has($error_name) ? ' has-error' : '') . "'>";
    $string .= Form::label($name, $title);

    if (is_object($object)) {
        $currentData = $object->{$name} ?: '';
    } else {
        $currentData = null;
    }

    $string .= Form::textarea($name, old($name, $currentData), $options);
    $string .= $errors->first($error_name, '<span class="help-block">:message</span>');
    $string .= '</div>';

    return new HtmlString($string);
});


Form::macro('normalInputGroup', function ($name, $title, ViewErrorBag $errors, $object = null, array $options = [], $addon=null) {

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title], $options);

    $string = "<div class='form-group" . ($errors->has($name) ? ' has-error' : '') . "'>";
    $string .= Form::label($name, $title);

    if (is_object($object)) {
        $currentData = isset($object->{$name}) ? $object->{$name} : '';
    } else {
        $currentData = null;
    }

    $string .= $addon ? '<div class="input-group">' : '';
    $string .= Form::text($name, old($name, $currentData), $options);
    $string .= $addon ? '<div class="input-group-addon">'.$addon.'</div>' : '';
    $string .= $addon ? '</div>' : '';
    $string .= $errors->first($name, '<span class="help-block">:message</span>');
    $string .= '</div>';

    return new HtmlString($string);
});


Form::macro('arrayInputGroup', function ($name, $title, ViewErrorBag $errors, $object = null, array $options = [], $addon=null) {

    $error_name = str_replace('[', '.', $name);
    $error_name = str_replace(']', '', $error_name);

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title], $options);

    $string = "<div class='form-group " . ($errors->has($error_name) ? ' has-error' : '') . "'>";
    $string .= Form::label($name, $title);

    if (is_object($object)) {
        $objName = explode('[', str_replace(']', '', $name));
        $currentData = isset($object->{$objName[0]}->{$objName[1]}) ? $object->{$objName[0]}->{$objName[1]} : '';
    } else {
        $currentData = null;
    }

    $string .= $addon ? '<div class="input-group">' : '';
    $string .= Form::text($name, old($name, $currentData), $options);
    $string .= $addon ? '<div class="input-group-addon">'.$addon.'</div>' : '';
    $string .= $addon ? '</div>' : '';
    $string .= $errors->first($name, '<span class="help-block">:message</span>');
    $string .= '</div>';

    return new HtmlString($string);
});