<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @copyright Copyright (c) 2015 Apiary Ltd. <support@apiary.io>
 */

namespace ZFTest\Apigility\Documentation\ApiBlueprint;

use PHPUnit_Framework_TestCase as TestCase;
use ZF\Apigility\Documentation\ApiBlueprint\Action;

class ActionTest extends TestCase
{
	public function setUp () {
		$baseOperationMock = $this->getMockBuilder('ZF\Apigility\Documentation\Operation')->getMock(); 
		$this->setExpectation($baseOperationMock, 'getDescription', 'Mock Operation Description');
		$this->setExpectation($baseOperationMock, 'getHttpMethod', 'POST');
		$this->setExpectation($baseOperationMock, 'getRequestDescription', 'Mock request description');
		$this->setExpectation($baseOperationMock, 'getResponseDescription', 'Mock response description');
		$this->action = new Action($baseOperationMock);
	}

	public function testActionDescription() {
		$this->assertEquals($this->action->getDescription(), 'Mock Operation Description');
	}

	public function testActionHttpMethod() {
		$this->assertEquals($this->action->getHttpMethod(), 'POST');
	}

	public function testIsEntityChangingMethod() {
		$this->assertTrue($this->action->isEntityChanging());
	}

	public function testActionRequestDescription() {
		$this->assertEquals($this->action->getRequestDescription(), 'Mock request description');
	}

	public function testActionResponseDescription() {
		$this->assertEquals($this->action->getResponseDescription(), 'Mock response description');
	}

	private function setExpectation ($baseOperationMock, $methodName, $returnValue) {
		$baseOperationMock->expects($this->any())->method($methodName)->will($this->returnValue($returnValue));
	}

}