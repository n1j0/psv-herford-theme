<?php
add_action('rest_api_init', 'sign_in');
add_action('rest_api_init', 'sign_out');

function sign_in() {
    register_rest_route('corona', 'in', array(
        'methods' => 'POST',
        'callback' => 'sign_user_in',
    ));
}

function sign_user_in($request) {
    $params = $request->get_params();
    return rest_ensure_response('');
}

function sign_out() {
    register_rest_route('corona', 'out', array(
        'methods' => 'POST',
        'callback' => 'sign_user_out',
    ));
}

function sign_user_out($request) {
    $params = $request->get_params();
    return rest_ensure_response('');
}
?>
