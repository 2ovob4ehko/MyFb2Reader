<?php
class Fb2 {
  private $bookFile;
  private $bookTitle;
  private $bookAuthor;
  private $bookGenre;
  private $bookAnnotation;
  private $bookCoverImage;
  private $bookLang;
  private $bookYear;
  private $publishInfo;
  private $firstTitle;
  private $sections=[];

  function __construct($url) {
    $xml=simplexml_load_file($url);
    if($xml===false){
      return false;
    }else{
      $this->bookFile=$xml;
      $t_info=$this->bookFile->description->{'title-info'};
      $this->bookTitle=(string) $t_info->{'book-title'};
      $this->bookAuthor=$t_info->author->{'first-name'}.' '.$t_info->author->{'last-name'};
      $this->bookGenre=(string) $t_info->genre;
      $this->bookAnnotation=$t_info->annotation->asXML();
      $this->bookYear=(string) $t_info->date;
      $this->bookLang=(string) $t_info->lang;
      $this->publishInfo=$this->bookFile->description->{'publish-info'}->asXML();
      foreach ($this->bookFile->body->title->children() as $child){
        $this->firstTitle.=$child->asXML();
      }
      for($i=1;$i<count($this->bookFile->body->children());$i++){
        array_push($this->sections,$this->bookFile->body->children()[$i]->asXML());
      }
      $this->bookCoverImage='data:image/jpeg;base64,'.$this->bookFile->binary;
      return true;
    }
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
  public function getBookInfo(){
    return (object) array(
      'title'=>$this->bookTitle,
      'author'=>$this->bookAuthor,
      'genre'=>$this->genreToString($this->bookGenre),
      'annotation'=>$this->bookAnnotation,
      'year'=>$this->bookYear,
      'lang'=>$this->bookLang
    );
  }
  public function getPublishInfo(){
    return $this->publishInfo;
  }
  public function getFirstTitle(){
    return $this->firstTitle;
  }
  public function getSections(){
    return $this->sections;
  }
  public function getCoverImage(){
    return $this->bookCoverImage;
  }
  private function genreToString($name){
    $st=array(
      'sf_cyberpunk'=>'кіберпанк фантастика',
      'sf_social'=>'соціальна фантастика'
    );
    return $st[$name];
  }
}
?>
