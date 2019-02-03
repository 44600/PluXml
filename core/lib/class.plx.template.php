<?php

/**
 * plxTemplates class is in charge of templates management
 *
 * @package PLX
 * @author	Pedro "P3ter" CADETE
 **/

class PlxTemplate {
    
    private $_templateFolder;                       // the template's relative path
    private $_templateName;                         // the template's name
    private $_templateType;                         // the template's type : post, page or email
    private $_templateEmailName;                    // the sender's name for an email template
    private $_templateEmailFrom;                    // the sender's email address for email template type
    private $_templateEmailSubject;                 // the subject for an email template type 
    private $_templateRawContent;                   // the template's content from filesystem
    private $_templateGeneratedContent;             // generated content from a template
    
    /**
     * Init the templat's name, its raw and generated content
     * 
     * @param   $templateName                   string      template's file name
     * @param   $templatePlaceholderValues      array       placeholder's values to replace in the raw template ("##PLACEHOLDER##" => "value")
     * @author  Pedro "P3ter" CADETE
     */
    public function __construct (string $templateFileName, $templatePlaceholdersValues = array()){
        
        $this->_templateFolder = PLX_CORE."templates/";
        $template = $this->parseTemplate($this->_templateFolder.$templateFileName);
        
        $this->setTemplateName($template['name']);
        $this->setTemplateType($template['type']);
        
        if ($this->getTemplateType() == 'email') {
            $this->setTemplateEmailName($template['emailname']);
            $this->setTemplateEmailFrom($template['emailfrom']);
            $this->setTemplateEmailSubject($template['emailsubject']);
        }
        
        if ($this->setTemplateRawContent($template['content']) AND !empty($templatePlaceholdersValues))
            $this->setTemplateGeneratedContent($templatePlaceholdersValues);
    }
    
    /**
     * Set the template's name
     * 
     * @param   $name   string      template's name
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateName (string $name){
        
        $this->_templateName = $name;
        return;
    }
    
    /**
     * Set the template's type
     *
     * @param   $type   string      template's type (post, page, email)
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateType (string $type){
        
        $this->_templateType = $type;
        return;
    }
    
    /**
     * Set the name of the email sender
     *
     * @param   $emailName   string      template's emailname
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateEmailName (string $emailName){
        
        $this->_templateEmailName = $emailName;
        return;
    }
    
    /**
     * Set the "from" email address  
     *
     * @param   $emailFrom   string      template's emailfrom
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateEmailFrom (string $emailFrom){
        
        $this->_templateEmailFrom = $emailFrom;
        return;
    }
    
    /**
     * Set the email subject
     *
     * @param   $emailFrom   string      template's emailsubject
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateEmailSubject (string $emailSubject){
        
        $this->_templateEmailSubject = $emailSubject;
        return;
    }
    
    /**
     * Set the template's content
     *
     * @param   content     string      template's content
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateRawContent(string $content) {
        
        $this->_templateRawContent = $content;
        return;
    }
    
    /**
     * Set the template's generated content
     *
     * @param   $templatePlaceholder    array       placeholder's values to replace in the raw template ("##PLACEHOLDER##" => "value")
     * @return
     * @author  Pedro "P3ter" CADETE
     */
    public function setTemplateGeneratedContent(array $placeholdersValues) {
        
        if (!empty($this->_templateRawContent))
            $this->_templateGeneratedContent = str_replace(array_keys($placeholdersValues), array_values($placeholdersValues), $this->_templateRawContent);
        
        return;
    }

    /**
     * Get the template's name
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateName (){
        
        return $this->_templateName;
    }
    
    /**
     * Get the template's type
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateType (){
        
        return $this->_templateType;
    }
    
    /**
     * Get the template's emailName
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateEmailName (){
        
        return $this->_templateEmailName;
    }
    
    /**
     * Get the template's emailFrom
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateEmailFrom (){
        
        return $this->_templateEmailFrom;
    }
    
    /**
     * Get the template's emailSubject
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateEmailSubject (){
        
        return $this->_templateEmailSubject;
    }
    
    /**
     * Get the template's raw content
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateRawContent (){
        
        return $this->_templateRawContent;
    }
    
    /**
     * Get the generated content from the raw template
     * @return  string
     * @author  Pedro "P3ter" CADETE
     */
    public function getTemplateGeneratedContent ($placeholdersValues){
        
        if (empty($this->_templateGeneratedContent) AND !empty($placeholdersValues))
            $this->setTemplateGeneratedContent($placeholdersValues);

        return $this->_templateGeneratedContent;
    }
    
    /**
     * Method in charge of parsing templates XML files
     *
     * @param	filename	fichier de l'article à parser
     * @return	array
     * @author	Pedro "P3ter" CADETE
     **/
    protected function parseTemplate($fileName) {
        
        # parser initialisation
        $data = implode('',file($fileName));
        $parser = xml_parser_create('UTF-8');
        $values = '';
        $index = '';
        $template = array();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,0);
        xml_parse_into_struct($parser,$data,$values,$index);
        xml_parser_free($parser);
        
        # getting datas from the parser
        $template['name'] = plxUtils::getValue($values[$index['name'][0]]['value']);
        $template['type'] = plxUtils::getValue($values[$index['type'][0]]['value']);
        if ($template['type'] == 'email') {
            $template['emailname'] = plxUtils::getValue($values[$index['emailname'][0]]['value']);
            $template['emailfrom'] = plxUtils::getValue($values[$index['emailfrom'][0]]['value']);
            $template['emailsubject'] = plxUtils::getValue($values[$index['emailsubject'][0]]['value']);
        }
        $template['content'] = plxUtils::getValue($values[$index['content'][0]]['value']);
        
        return $template;
    }
}

?>