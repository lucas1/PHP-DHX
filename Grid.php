<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Grid
class Grid extends DHX {
    private $document; // ref document 
    private $rows; // ref rows
    private $head; // ref head
    private $beforeInit; // ref beforeInit
    private $afterInit; // ref afterInit
    public $pos; // set pos
    public $total_count; // set total_count
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->rows = $this->document->appendChild(new DOMElement('rows'));
    }
    
    // public column
    public function column(){
        $data = func_get_args();
        foreach($data as $row){
            $column = '';
            if($this->head){
                $column = $this->head->appendChild(new DOMElement('column'));   
            }else{
                $this->head = $this->rows->appendChild(new DOMElement('head'));
                $column = $this->head->appendChild(new DOMElement('column'));
            }
            foreach($row as $key => $value){
                if($key == 'option'){
                    if(array_key_exists(0, $value)){
                        foreach($value as $r){
                            $option = $column->appendChild(new DOMElement('option'));
                            foreach($r as $k => $v){
                                if($k == 'text'){
                                    $option->appendChild($this->document->createTextNode($v));
                                }else{
                                    $option->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }
                    }else{
                        $option = $column->appendChild(new DOMElement('option'));
                        foreach($value as $k => $v){
                            if($k == 'text'){
                                $option->appendChild($this->document->createTextNode($v));
                            }else{
                                $option->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }
                }elseif($key == 'label'){
                    $column->appendChild($this->document->createTextNode($value));
                }else{
                    $column->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public settings
    public function settings($data){
        $settings = '';
        if($this->head){
            $settings = $this->head->appendChild(new DOMElement('settings'));   
        }else{
            $this->head = $this->rows->appendChild(new DOMElement('head'));
            $settings = $this->head->appendChild(new DOMElement('settings'));
        }
        foreach($data as $key => $value){
            $s = $settings->appendChild(new DOMElement($key));
            $s->appendChild($this->document->createTextNode($value));
        }
    }
    
    // public beforeInit
    public function beforeInit(){
        $data = func_get_args();
        $call = '';
        if($this->beforeInit){
            $call = $this->beforeInit->appendChild(new DOMElement('call'));
        }else{
            if($this->head){
                $this->beforeInit = $this->head->appendChild(new DOMElement('beforeInit'));   
            }else{
                $this->head = $this->rows->appendChild(new DOMElement('head'));
                $this->beforeInit = $this->head->appendChild(new DOMElement('beforeInit'));
            }
            $call = $this->beforeInit->appendChild(new DOMElement('call'));
        }
        $param = $call->appendChild(new DOMElement('param'));
        $values = '';
        $num = 1;
        foreach($data as $value){
            if($num == 1){
                $call->setAttributeNode(new DOMAttr('command', $value));
            }else{
                if($values){
                    $values .= ',' . $value;
                }else{
                    $values .= $value;
                }
            }
            $num++;
        }
        $param->appendChild($this->document->createTextNode($values));
    }
    
    // public afterInit
    public function afterInit(){
        $data = func_get_args();
        $call = '';
        if($this->afterInit){
            $call = $this->afterInit->appendChild(new DOMElement('call'));
        }else{
            if($this->head){
                $this->afterInit = $this->head->appendChild(new DOMElement('afterInit'));   
            }else{
                $this->head = $this->rows->appendChild(new DOMElement('head'));
                $this->afterInit = $this->head->appendChild(new DOMElement('afterInit'));
            }
            $call = $this->afterInit->appendChild(new DOMElement('call'));
        }
        $call->setAttributeNode(new DOMAttr('command', $command));
        $param = $call->appendChild(new DOMElement('param'));
        $values = '';
        $num = 1;
        foreach($data as $value){
            if($num == 1){
                $call->setAttributeNode(new DOMAttr('command', $value));
            }else{
                if($values){
                    $values .= ',' . $value;
                }else{
                    $values .= $value;
                }
            }
            $num++;
        }
        $param->appendChild($this->document->createTextNode($values));
    }
    
    // public row
    public function row(){
        $data = func_get_args();
        foreach($data as $rows){
            $row = $this->rows->appendChild(new DOMElement('row'));
            foreach($rows as $key => $value){
                if($key == 'cell'){
                    foreach($value as $r){
                        $cell = $row->appendChild(new DOMElement('cell'));
                        if(is_array($r)){
                            foreach($r as $k => $v){
                                if($k == 'text'){
                                    $cell->appendChild($this->document->createTextNode($v));
                                }else{
                                    $cell->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }else{
                            $cell->appendChild($this->document->createTextNode($r));
                        }
                    }
                }elseif($key == 'userdata'){
                    if(array_key_exists(0, $value)){
                        foreach($value as $r){
                            $userdata = $row->appendChild(new DOMElement('userdata'));
                            foreach($r as $k => $v){
                                if($k == 'value'){
                                    $userdata->appendChild($this->document->createTextNode($v));
                                }else{
                                    $userdata->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }
                    }else{
                        $userdata = $row->appendChild(new DOMElement('userdata'));
                        foreach($value as $k => $v){
                            if($k == 'value'){
                                $userdata->appendChild($this->document->createTextNode($v));
                            }else{
                                $userdata->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }
                }else{
                    $row->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public cell
    public function cell(){
        $data = func_get_args();
        $row = $this->rows->appendChild(new DOMElement('row'));
        $num = 1;
        foreach($data as $value){
            if($num == 1){
                $row->setAttributeNode(new DOMAttr('id', $value));
            }else{
                $cell = $row->appendChild(new DOMElement('cell'));
                $cell->appendChild($this->document->createTextNode($value));
            }
            $num++;
        }
    }
    
    
    // public userdata
    public function userdata(){
        $data = func_get_args();
        foreach($data as $row){
            $userdata = $this->rows->appendChild(new DOMElement('userdata'));
            foreach($row as $key => $value){
                if($key == 'value'){
                    $userdata->appendChild($this->document->createTextNode($value));
                }else{
                    $userdata->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        if($this->pos){
            $this->rows->setAttributeNode(new DOMAttr('pos', $this->pos));
        }
        if($this->total_count){
            $this->rows->setAttributeNode(new DOMAttr('total_count', $this->total_count));
        }
        return $this->document->saveXML();
    }
}