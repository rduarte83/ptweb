<?php

echo $query ;
echo '<br>';

$query2 = '
CREATE OR REPLACE FUNCTION f_activeUser() 
RETURNS integer AS $$ 
DECLARE activeuser int := :id; 
BEGIN RETURN activeuser; 
END 
$$ LANGUAGE plpgsql 
SECURITY DEFINER;';

echo $query2;