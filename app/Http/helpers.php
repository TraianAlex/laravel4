<?php

function delete_form($routeParams, $label = 'Delete')
{
	$form = Form::open(['route' => $routeParams, 'method' => 'DELETE']);
	$form .= Form::submit($label, ['class' => 'btn btn-danger form-control']);
	return $form .= Form::close();
}