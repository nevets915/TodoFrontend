<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helpme
 *
 * @author namblue
 */
class Helpme extends Application
{
    public function index()
    {
        $this->data['pagetitle'] = 'Help Wanted!';
        $stuff = file_get_contents('../data/jobs.md');
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render();
        
        // Not working, $parameters are undefined
        //$stuff = file_get_contents('../data/jobs.md');
        //$htmlstuff = $this->parsedown->parse($stuff);
        //$this->data['content'] = $this->parser->parse_string($htmlstuff,$parameters,true);
        //$this->render('template-secondary'); 
    }
}
