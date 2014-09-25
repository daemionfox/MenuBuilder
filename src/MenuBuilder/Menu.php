<?php
/**
 * Menu.php
 *
 * @author Matt Sowers <matt@rcsipublishing.com>
 *
 */

namespace DaemionFox\MenuBuilder;

class Menu
{
    private $fullMenu = array();
    private static $idCounter = 0;

    public function __construct($menu = null, $filter = null)
    {
        if ($menu !== null) {
            $this->loadMenu($menu);  // Decided to use the setter here, because it will throw an exception
        }
    }

    public function loadMenu($menu)
    {
        if (is_array($menu)) {
            $this->fullMenu =  $menu;
        } else {
            throw new \Exception("Bad menu array.  Expecting type array, got " . gettype($menu));
        }
    }

    public function raw($filter = array())
    {
        return $this->buildMenu($filter);
    }

    public function json($filter = array())
    {
        return json_encode($this->buildMenu($filter));
    }

    public function ul($filter = array())
    {
        $menu = $this->buildMenu($filter);
        return $this->buildChild($menu, 'ul', 'li');
    }

    public function div($filter = array())
    {
        $menu = $this->buildMenu($filter);
        return $this->buildChild($menu, 'div', 'div');
    }

    private function buildChild($child, $container, $list, $level = 0)
    {
        $lead = str_repeat("\t", $level);
        $out = $lead . "<" . $container . " class='menu level_" . $level . "'>\n";
        foreach ($child as $contents) {
            $data = $contents["contents"];
            $class  = isset($contents["class"]) ? $contents["class"] : '';
            $id     = isset($contents["id"]) ? $contents["id"] : 'menu_' . self::$idCounter++;
            $text   = isset($data["text"]) ? $data["text"] : '';

            $url    = isset($data["url"]) ? "href='" . $data["url"] . "' ": '';
            $target = isset($data["target"]) ? "target='" . $data["target"] . "' ": '';
            $click  = isset($data["onclick"]) ? "onclick='" . $data["onclick"] . "' ": '';
            $style  = isset($data["style"]) ? "style='" . $data["style"] . "' ": '';
            $useUrl = $url !== '' || $click != '';
            $hasKids = (
                 isset($contents["children"]) &&
                 is_array($contents["children"]) &&
                 count($contents["children"]) > 0
            );

            $out .= $lead . "\t<" . $list . " id='" . $id . "' class='" . $class . "'>";
            if ($useUrl) {
                $out .= "\n" . $lead . "\t\t<a " . implode(" ", array($url, $target, $click, $style)) . ">";
            }
            $out .= $text;
            if ($useUrl) {
                $out .= "</a>\n" . $lead . "\t";
            }

            if ($hasKids) {
                $out .= "\n" . $this->buildChild($contents["children"], $container, $list, $level+1);
            }

            $out .= "</" . $list . ">\n";
        }
        $out .= $lead . "</" . $container . ">\n";
        return $out;
    }

    private function buildMenu($filter)
    {
        $menu = $this->addRecurseMenu($filter, $this->fullMenu);
        return $menu;
    }

    private function addRecurseMenu($filter, $menu)
    {
        $out = array();
        foreach ($menu as $key => $contents) {
            $sub = null;
            if (is_array($contents["children"])) {
                $sub = $this->addRecurseMenu($filter, $contents["children"]);
            }
            if ($this->multiInArray($filter, $contents["filter"])) {
                $out[$key] = $contents;
                unset($out[$key]["children"]);
                $out[$key]["children"] = $sub;
                unset($out[$key]["filter"]);
            }
        }
        return $out;
    }

    private function multiInArray($needle, $haystack)
    {
        if ($haystack === null) {
            return true;
        }
        foreach ($needle as $n) {
            if (in_array($n, $haystack)) {
                return true;
            }
        }
        return false;
    }
}





