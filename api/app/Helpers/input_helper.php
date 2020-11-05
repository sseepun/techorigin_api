<?php

function stdClassToArray($stdObject){
    return json_decode(json_encode($stdObject), true);
}
