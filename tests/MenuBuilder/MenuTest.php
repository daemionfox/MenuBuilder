<?php
/**
 * MenuTest.php
 *
 * @author Matt Sowers <matt@rcsipublishing.com>
 *
 */



class MenuTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct()
    {
        $arr = array(
             "foo" => array(
                  "id" => "fooMenu",
                  "class" => "nav",
                  "filter" => null,
                  "contents" => array(
                       "text" => "Foo",
                       "url" => null,
                       "target" => null,
                       "onclick" => null,
                       "style" => null,
                  ),
                  "children" => null,
             ),
             "bar" => array(
                  "id" => "barMenu",
                  "class" => "nav",
                  "filter" => null,
                  "contents" => array(
                       "text" => "Bar",
                       "url" => null,
                       "target" => null,
                       "onclick" => null,
                       "style" => null,
                  ),
                  "children" => array(
                       "foobar" => array(
                            "id" => "foobarMenu",
                            "class" => "nav",
                            "filter" => null,
                            "contents" => array(
                                 "text" => "Foobar",
                                 "url" => null,
                                 "target" => null,
                                 "onclick" => null,
                                 "style" => null,
                            ),
                            "children" => null,
                       )
                  ),
             ),
        );

        $expected = array(
             "foo" => array(
                  "id" => "fooMenu",
                  "class" => "nav",
                  "contents" => array(
                       "text" => "Foo",
                       "url" => null,
                       "target" => null,
                       "onclick" => null,
                       "style" => null,
                  ),
                  "children" => null,
             ),
             "bar" => array(
                  "id" => "barMenu",
                  "class" => "nav",
                  "contents" => array(
                       "text" => "Bar",
                       "url" => null,
                       "target" => null,
                       "onclick" => null,
                       "style" => null,
                  ),
                  "children" => array(
                       "foobar" => array(
                            "id" => "foobarMenu",
                            "class" => "nav",
                            "contents" => array(
                                 "text" => "Foobar",
                                 "url" => null,
                                 "target" => null,
                                 "onclick" => null,
                                 "style" => null,
                            ),
                            "children" => null,
                       )
                  ),
             ),
        );



        $menu = new \DaemionFox\MenuBuilder\Menu($arr);
        $result = $menu->raw();
        $this->assertSame($result, $expected);



    }


}
