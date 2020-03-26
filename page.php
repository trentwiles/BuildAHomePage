<?php
  
  // THIS IS THE CODE THAT CREATES THE A ELEMENT
  //Just a note, I did not create this section!
class html_element
{
	/* vars */
	var $type;
	var $attributes;
	var $self_closers;
	
	/* constructor */
	function html_element($type,$self_closers = array('input','img','hr','br','meta','link','h1'))
	{
		$this->type = strtolower($type);
		$this->self_closers = $self_closers;
	}
	
	/* get */
	function get($attribute)
	{
		return $this->attributes[$attribute];
	}
	
	/* set -- array or key,value */
	function set($attribute,$value = '')
	{
		if(!is_array($attribute))
		{
			$this->attributes[$attribute] = $value;
		}
		else
		{
			$this->attributes = array_merge($this->attributes,$attribute);
		}
	}
	
	/* remove an attribute */
	function remove($att)
	{
		if(isset($this->attributes[$att]))
		{
			unset($this->attributes[$att]);
		}
	}
	
	/* clear */
	function clear()
	{
		$this->attributes = array();
	}
	
	/* inject */
	function inject($object)
	{
		if(@get_class($object) == __class__)
		{
			$this->attributes['text'].= $object->build();
		}
	}
	
	/* build */
	function build()
	{
		//start
		$build = '<'.$this->type;
		
		//add attributes
		if(count($this->attributes))
		{
			foreach($this->attributes as $key=>$value)
			{
				if($key != 'text') { $build.= ' '.$key.'="'.$value.'"'; }
			}
		}
		
		//closing
		if(!in_array($this->type,$this->self_closers))
		{
			$build.= '>'.$this->attributes['text'].'</'.$this->type.'>';
		}
		else
		{
			$build.= ' />';
		}
		
		//return it
		return $build;
	}
	
	/* spit it out */
	function output()
	{
		echo $this->build();
	}
}
// All of the fancy stuff...
echo '<center>    <div id="fullScreenDiv">
        <div id="videoDiv">           
            <video id="video" autoplay loop muted>
            <source src="https://cdn.glitch.com/c6e2fb68-b6fa-497a-8990-4961d0f7a112%2FPexels%20Videos%201409899.mp4?v=1584471708204" type="video/mp4"></source>
            </video> 
        </div>
        <div id="messageBox"> 
            <div><div class="main">';
$my_anchor = new html_element('a');
$my_anchor->set('href','https://example.com');
$my_anchor->set(array('href'=>$_GET['link'],'target'=>'blank','text'=>$_GET['title']));
$my_anchor->output();
// end <a> creation


echo '<h2> ' . htmlspecialchars($_GET["line"]) . '</h2>';
echo '<h3> ' . htmlspecialchars($_GET["about"]) . '</h3>';
?>
  <link href="home.css" rel="stylesheet">