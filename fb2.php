<?php
class Fb2 {
  private $bookFile;
  private $bookTitle;
  private $bookAuthor;
  private $bookGenre;
  private $bookAnnotation;
  private $bookCoverPage;
  private $bookLang;
  private $bookYear;
  private $publishInfo;
  private $firstTitle;
  private $sections;

  function __construct() {

  }
  function __toString() {
    return (string) $this->bookAuthor.' '.$this->bookTitle.' ('.$this->bookGenre.') - '.$this->bookYear;
  }
  public function setBookFile($url){
    $xml=simplexml_load_file($url);
    if($xml===false){
      return false;
    }else{
      $this->bookFile=$xml;
      return true;
    }
  }
  public function getInfo(){
    if(!isset($this->bookFile)){
      throw new Exception('Book file is not set');
    }else{
      $info=$this->bookFile->description->{'title-info'};
      $this->bookTitle=(string) $info->{'book-title'};
      $this->bookAuthor=$info->author->{'first-name'}.' '.$info->author->{'last-name'};
      return (object) array(
        'title'=>$this->bookTitle,
        'author'=>$this->bookAuthor
      );
    }
  }
}
?>
