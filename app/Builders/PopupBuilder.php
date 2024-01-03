<?php
namespace App\Builders;
use App\Factories\PopupFactory;
use App\Models\Popup;

class PopupBuilder
{
    protected $popup;

    public function __construct()
    {
        $this->popup = [];
    }
//json content from ckeditor that have content ,layout ,styling and we can Add Form and Buttom features to ckeditor
    public function setContent(string $content)
    {
        $this->popup['content'] = $content;
        return $this;
    }
//Full Screen or Slide In or Exit Intent
    public function setType(string $type)
    {
        $this->popup['type'] = $type;
        return $this;
    }

//name of popups
    public function setName(string $name)
    {
        $this->popup['name'] = $name;
        return $this;
    }
//page that include the popup
    public function setScheduled_pages(string $scheduled_pages)
    {
        $this->popup['scheduled_pages'] = $scheduled_pages;
        return $this;
    }
    
    public function build()
    {
        return PopupFactory::create($this->popup);
    }

    public function save()
    {
        $popup = $this->build();
        $popup->save();

        return $popup;
    }
}