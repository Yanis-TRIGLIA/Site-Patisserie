<?php
echo "<p>" . $A_vue['helloworld']  . "</p>";
$tableau = modele_test::readAll();
foreach ($tableau as $ligne) {
  echo $ligne->NAME . "/";
}