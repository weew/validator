<?php


namespace Weew\Validator\Constraints;


use PHPUnit_Framework_TestCase;

class UrlConstraintTest extends PHPUnit_Framework_TestCase {

    public function test_check() {
        $c = new UrlConstraint();
        $this->assertTrue($c->check('ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt'));
        $this->assertTrue($c->check('http://www.math.uio.no.example.net/faq/compression-faq/part1.html'));
        $this->assertTrue($c->check('mailto:mduerst@ifi.unizh.example.gov'));
        $this->assertTrue($c->check('news:comp.infosystems.www.servers.unix'));
        $this->assertTrue($c->check('telnet://melvyl.ucop.example.edu/'));
        $this->assertTrue($c->check('ldap://[2001:db8::7]/c=GB?objectClass?one'));
        $this->assertTrue($c->check('telnet://192.0.2.16:80/'));
        $this->assertFalse($c->check('telnet://192.0.2.16:80/ '));
        $this->assertFalse($c->check('tel:+1-816-555-1212'));
        $this->assertFalse($c->check('urn:oasis:names:specification:docbook:dtd:xml:4.1.2'));

    }

    public function test_to_array() {
        $c = new UrlConstraint();
        $this->assertEquals([], $c->toArray());
    }

}