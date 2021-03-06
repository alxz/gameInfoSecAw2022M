<?php
require_once('config.php');

class Question {
  // Properties
  //qId, qTxt, qIsTaken, qIsAnswered FROM tabQuestions";
  public $qId;
  public $qTxt;
  public $qTxtFRA;
  public $qIsTaken;
  public $qIsAnswered;
  public $listAnswers;
  public $validAnswer;
  public $questionURL;
  public $questionurlFRA;
  public $topicid;

  // Methods
  function set_qId($qId) {
    $this->qId = $qId;
  }
  function get_qId() {
    return $this->qId;
  }
  function set_qTxt($qTxt) {
    $this->qTxt = $qTxt;
  }
  function get_qTxt() {
    return $this->qTxt;
  }

  function set_qIsTaken($qIsTaken) {
    $this->qIsTaken= $qIsTaken;
  }
  function get_qIsTaken() {
    return $this->qIsTaken;
  }
  function set_qIsAnswered($qIsAnswered) {
    $this->qIsAnswered = $qIsAnswered;
  }
  function get_qIsAnswered() {
    return $this->qIsAnswered;
  }
  //$listAnswers
  function set_listAnswers($listAnswers) {
    $this->listAnswers = $listAnswers;
  }
  function get_listAnswers() {
    return $this->listAnswers;
  }

  function set_validAnswer($validAnswer) {
    $this->validAnswer = $validAnswer;
  }
  function get_validAnswer() {
    return $this->validAnswer;
  }

  function set_questionURL($questionURL) {
    $this->questionURL = $questionURL;
  }
  function get_questionURL() {
    return $this->questionURL;
  }

  function set_qTxtFRA($qTxtFRA) {
    $this->qTxtFRA = $qTxtFRA;
  }
  function get_qTxtFRA() {
    return $this->qTxtFRA;
  }

  function set_questionurlFRA($questionurlFRA) {
    $this->questionurlFRA = $questionurlFRA;
  }
  function get_questionurlFRA() {
    return $this->questionurlFRA;
  }

  function set_topicid($topicid) {
    $this->topicid = $topicid;
  }
  
  function get_topicid() {
    return $this->topicid;
  }
}

class Answer {
  // Properties
  // `ansId`, `ansTxt`, `ansQId`, `ansIsValid` FROM tabanswers";
  public $ansId;
  public $ansTxt;
  public $ansQId;
  public $ansIsValid;
  public $ansTxtFRA;

  // Methods
  function set_ansId($ansId) {
    $this->ansId = $ansId;
  }
  function get_ansId() {
    return $this->ansId;
  }
  function set_ansTxt($ansTxt) {
    $this->ansTxt = $ansTxt;
  }
  function get_ansTxt() {
    return $this->ansTxt;
  }

  function set_ansQId($ansQId) {
    $this->ansQId= $ansQId;
  }
  function get_ansQId() {
    return $this->ansQId;
  }
  function set_ansIsValid($ansIsValid) {
    $this->ansIsValid = $ansIsValid;
  }
  function get_ansIsValid() {
    return $this->ansIsValid;
  }

  function set_ansTxtFRA($ansTxtFRA) {
    $this->ansTxtFRA = $ansTxtFRA;
  }
  function get_ansTxtFRA() {
    return $this->ansTxtFRA;
  }
}

?>
