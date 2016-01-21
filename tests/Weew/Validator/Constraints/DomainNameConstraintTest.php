<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\DomainNameConstraint;

class DomainNameConstraintTest extends PHPUnit_Framework_TestCase{
    public function test_check() {
        $c = new DomainNameConstraint();
        $this->assertFalse($c->check(1));
        $this->assertTrue($c->check('domain.com'));
        $this->assertTrue($c->check('www.domain.com'));
        $this->assertTrue($c->check('www.with.subdomains.domain.com'));
        $this->assertFalse($c->check('http://wwww.domain.com'));
        $this->assertFalse($c->check('do-main-.com'));
        $this->assertFalse($c->check('do-main--.com'));
        $this->assertFalse($c->check('-domain-.-.com'));
        $this->assertFalse($c->check('-domain.com'));
        $this->assertFalse($c->check('according.to.wikipedia.a.domain.name.must.not.exceed.a.length.of.about.twohundretandfiftyfivecharacters.otherwise.it.will.be.not.a.valid.domain.name.however.i.could.never.find.this.in.any.rfc.linked.from.the.article.however.i.implemented.it.nonetheless.com'));
    }

    public function test_get_options() {
        $c = new DomainNameConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new DomainNameConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new DomainNameConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
