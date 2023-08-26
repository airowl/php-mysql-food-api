<?php

function responseJson($data){
    header('Content-type: Application/json');

    die($data);
}