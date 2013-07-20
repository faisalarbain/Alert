<?php
use FaisalArbain\Alert\BootstrapAlert;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
class BootstrapAlertTest extends PHPUnit_Framework_TestCase {

	protected $alert;
	protected $session;
	public function setup()
	{
		$this->session = new Store(new MockArraySessionStorage);
		$this->alert = new BootstrapAlert($this->session);
		parent::setup();
	}

	public function tearDown()
	{

	}

    public function testCanCreateAlert()
    {
    	$this->assertNotNull($this->alert);
    }

    public function testCanAddAlert()
    {
    	$this->alert->add("success", "foo");

    	$session = $this->session->get(BootstrapAlert::$KEY);

    	$this->assertNotNull($session);
    }

    public function testCanGetAlert()
    {
    	$this->alert->add("success", "foo");
    	$this->assertEquals(array("foo"), $this->alert->get("success"));

    }

    public function testCanAddMoreAlert()
    {
    	$this->alert->add("success","foo");
    	$this->alert->add("success", "bar");

    	$this->assertEquals(array("foo","bar"), $this->alert->get("success"));
    }

    public function testCanAddOtherType()
    {
    	$this->alert->add("success", "foo");
    	$this->alert->add("error", "bar");

    	$this->assertEquals(array("bar"), $this->alert->get("error"));
    }

    public function testCanGetAllTypes()
    {
    	$this->alert->add("success", "foo");
    	$this->alert->add("error", "bar");

    	$this->assertEquals(array("success" => array("foo"), "error" => array("bar")), $this->alert->all());
    }

    public function testCanRender()
    {
    	$this->alert->add("success", "foo");
		$output = $this->alert->render();

    	$this->assertTrue(stripos($output, "alert") !== false);
    }

    public function testCanRenderMoreAlert()
    {
    	$this->alert->add("success","foo");
    	$this->alert->add("error", "foo");

    	$output = $this->alert->render();

    	$this->assertTrue(stripos($output, "alert-success") !== false);
    	$this->assertTrue(stripos($output, "alert-error") !== false);
    }

    public function testCanRenderPartialAlert()
    {
    	$this->alert->add("success","foo");
    	$this->alert->add("error", "foo");

    	$output = $this->alert->render("success");

    	$this->assertTrue(stripos($output, "alert-success") !== false);
    	$this->assertTrue(stripos($output, "alert-error") === false);
    }



}