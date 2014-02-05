<?php
use FaisalArbain\Alert\BootstrapAlert;
use Illuminate\Session\SessionInterface;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\Session\Session;
class BootstrapAlertTest extends PHPUnit_Framework_TestCase {

	protected $alert;
	protected $session;
	public function setup()
	{
		$this->session = new ArraySession();//Mockery::mock("Illuminate\Session\Store")->shouldIgnoreMissing(); //new Store("foo", new MockArraySessionStorage);
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

class ArraySession implements SessionInterface{

	protected $container = array();
	/**
	 * Returns the session ID.
	 *
	 * @return string The session ID.
	 *
	 * @api
	 */
	public function getId()
	{
		// TODO: Implement getId() method.
	}

	/**
	 * Sets the session name.
	 *
	 * @param string $name
	 *
	 * @api
	 */
	public function setName($name)
	{
		// TODO: Implement setName() method.
	}

	/**
	 * Migrates the current session to a new session id while maintaining all
	 * session attributes.
	 *
	 * @param Boolean $destroy Whether to delete the old session or leave it to garbage collection.
	 * @param integer $lifetime Sets the cookie lifetime for the session cookie. A null value
	 *                          will leave the system settings unchanged, 0 sets the cookie
	 *                          to expire with browser session. Time is in seconds, and is
	 *                          not a Unix timestamp.
	 *
	 * @return Boolean True if session migrated, false if error.
	 *
	 * @api
	 */
	public function migrate($destroy = false, $lifetime = null)
	{
		// TODO: Implement migrate() method.
	}

	/**
	 * Force the session to be saved and closed.
	 *
	 * This method is generally not required for real sessions as
	 * the session will be automatically saved at the end of
	 * code execution.
	 */
	public function save()
	{
		// TODO: Implement save() method.
	}

	/**
	 * Returns an attribute.
	 *
	 * @param string $name The attribute name
	 * @param mixed $default The default value if not found.
	 *
	 * @return mixed
	 *
	 * @api
	 */
	public function get($name, $default = null)
	{
		return isset($this->container[$name])? $this->container[$name] : $default;
	}

	/**
	 * Sets an attribute.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @api
	 */
	public function set($name, $value)
	{
		// TODO: Implement set() method.
	}

	/**
	 * Sets attributes.
	 *
	 * @param array $attributes Attributes
	 */
	public function replace(array $attributes)
	{
		// TODO: Implement replace() method.
	}

	/**
	 * Removes an attribute.
	 *
	 * @param string $name
	 *
	 * @return mixed The removed value or null when it does not exist
	 *
	 * @api
	 */
	public function remove($name)
	{
		// TODO: Implement remove() method.
	}

	/**
	 * Determine if the session handler needs a request.
	 *
	 * @return bool
	 */
	public function handlerNeedsRequest()
	{
		// TODO: Implement handlerNeedsRequest() method.
	}

	/**
	 * Set the request on the handler instance.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request $request
	 * @return void
	 */
	public function setRequestOnHandler(\Symfony\Component\HttpFoundation\Request $request)
	{
		// TODO: Implement setRequestOnHandler() method.
	}

	/**
	 * Invalidates the current session.
	 *
	 * Clears all session attributes and flashes and regenerates the
	 * session and deletes the old session from persistence.
	 *
	 * @param integer $lifetime Sets the cookie lifetime for the session cookie. A null value
	 *                          will leave the system settings unchanged, 0 sets the cookie
	 *                          to expire with browser session. Time is in seconds, and is
	 *                          not a Unix timestamp.
	 *
	 * @return Boolean True if session invalidated, false if error.
	 *
	 * @api
	 */
	public function invalidate($lifetime = null)
	{
		// TODO: Implement invalidate() method.
	}

	/**
	 * Checks if an attribute is defined.
	 *
	 * @param string $name The attribute name
	 *
	 * @return Boolean true if the attribute is defined, false otherwise
	 *
	 * @api
	 */
	public function has($name)
	{
		// TODO: Implement has() method.
	}

	/**
	 * Clears all attributes.
	 *
	 * @api
	 */
	public function clear()
	{
		// TODO: Implement clear() method.
	}

	/**
	 * Checks if the session was started.
	 *
	 * @return Boolean
	 */
	public function isStarted()
	{
		// TODO: Implement isStarted() method.
	}

	/**
	 * Registers a SessionBagInterface with the session.
	 *
	 * @param \Symfony\Component\HttpFoundation\Session\SessionBagInterface $bag
	 */
	public function registerBag(\Symfony\Component\HttpFoundation\Session\SessionBagInterface $bag)
	{
		// TODO: Implement registerBag() method.
	}

	/**
	 * Get the session handler instance.
	 *
	 * @return \SessionHandlerInterface
	 */
	public function getHandler()
	{
		// TODO: Implement getHandler() method.
	}

	/**
	 * Starts the session storage.
	 *
	 * @return Boolean True if session started.
	 *
	 * @throws \RuntimeException If session fails to start.
	 *
	 * @api
	 */
	public function start()
	{
		// TODO: Implement start() method.
	}

	/**
	 * Sets the session ID
	 *
	 * @param string $id
	 *
	 * @api
	 */
	public function setId($id)
	{
		// TODO: Implement setId() method.
	}

	/**
	 * Returns the session name.
	 *
	 * @return mixed The session name.
	 *
	 * @api
	 */
	public function getName()
	{
		// TODO: Implement getName() method.
	}

	/**
	 * Returns attributes.
	 *
	 * @return array Attributes
	 *
	 * @api
	 */
	public function all()
	{
		// TODO: Implement all() method.
	}

	/**
	 * Gets a bag instance by name.
	 *
	 * @param string $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Session\SessionBagInterface
	 */
	public function getBag($name)
	{
		// TODO: Implement getBag() method.
	}

	/**
	 * Gets session meta.
	 *
	 * @return \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag
	 */
	public function getMetadataBag()
	{
		// TODO: Implement getMetadataBag() method.
	}
	
	public function flash($key, $value){
	    $this->container[$key] = $value;
	}
}