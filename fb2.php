<?php
class Fb2 {
  private $bookFile;
  private $bookTitle;
  private $bookAuthor;
  private $bookGenre=[];
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
      for($i=0;$i<count($t_info->genre);$i++){
        array_push($this->bookGenre,(string) $t_info->genre[$i]);
      }
      foreach ($t_info->annotation->children() as $child){
        $this->bookAnnotation.=$child->asXML();
      }
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
      'genre'=>$this->genreToString(implode(", ",$this->bookGenre)),
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
    $code=array('sf_cyberpunk','sf_social','prose_contemporary','sf_fantasy','sf_horror','foreign_fantasy','thriller');
    $str=array('кіберпанк фантастика','соціальна фантастика','сучасна проза','фентезі','жах-фантастика','іноземне фентезі','триллер');
    return str_replace($code,$str,$name);;
  }
}
?>
