<?php
function fechaNormal($fecha){
$db = "";
                  $var = $fecha;
                  $dia = substr($var,8,2);
                  $mes = substr($var,5,2);
                  $anio = substr($var,0,4);
                  return $db = $dia."-".$mes."-".$anio;
               }