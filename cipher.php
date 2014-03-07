<?php
class Cipher {
  public $string;
  public $values = array();
  public $length;
  function __construct($string){
    $this->string = strtolower(str_replace(' ', '', $string ));
    $this->length = strlen($this->string);
    $abc = range('a', 'z');
    for( $i = 0 ; $i < $this->length ; $i++ ){
      for($num=0; $num < 26; $num++){
        if ($this->string[$i] == $abc[$num]){
          $this->values[$i] = $num;
        }
      }
    }
  }
}

$key = new Cipher($_POST['key']);
$text = new Cipher($_POST['message']);
$abc = range('a', 'z');

while($key->length < $text->length){
  $key->values = array_merge($key->values, $key->values);
  $key->length = count($key->values);
}
for($i=0; $i < $text->length; $i++){
  echo $abc[($key->values[$i] + $text->values[$i])%26];
}
?>
