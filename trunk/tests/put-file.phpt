--TEST--
Test putting a file on the server
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) print "skip";
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
$client = mogilefs_test_factory();
var_dump($client->put(__FILE__, 'foo', MOGILEFS_CLASS));
$result = $client->get('foo');
var_dump($result['path1']);
var_dump($result['paths']);
var_dump(file_get_contents(__FILE__) === file_get_contents($result['path1']));


var_dump($client->put('foobarbaz', 'bar', MOGILEFS_CLASS, false));
$result = $client->get('bar');
var_dump($result['path1']);
var_dump($result['paths']);
var_dump('foobarbaz' === file_get_contents($result['path1']));


var_dump($client->put('foobarbaz', 'bar', MOGILEFS_CLASS, true));

$obj = mogilefs_test_factory(true);
var_dump(mogilefs_put($obj, __FILE__, 'foobar', MOGILEFS_CLASS));
$result = mogilefs_get($obj, 'foobar');
var_dump($result['path1']);
var_dump($result['paths']);
var_dump(file_get_contents(__FILE__) === file_get_contents($result['path1']));

var_dump(mogilefs_put($obj, 'foobarbar', 'barfoo', MOGILEFS_CLASS, false));
$result = mogilefs_get($obj, 'barfoo');
var_dump($result['path1']);
var_dump($result['paths']);
var_dump('foobarbar' === file_get_contents($result['path1']));

var_dump(mogilefs_put($obj, 'foobarbar', 'bazbarfoo', MOGILEFS_CLASS, true));
?>
==DONE==
--EXPECTF--
bool(true)
string(%d) "http://%s.fid"
string(%d) "%d"
bool(true)
bool(true)
string(%d) "http://%s.fid"
string(%d) "%d"
bool(true)
bool(false)
bool(true)
string(%d) "http://%s.fid"
string(%d) "%d"
bool(true)
bool(true)
string(%d) "http://%s.fid"
string(%d) "%d"
bool(true)
bool(false)
==DONE==
