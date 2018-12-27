<?php
use Component\Container\Container;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\ZendConfigProvider;

$aggregator = new ConfigAggregator([
    new ZendConfigProvider(__DIR__ . '/parameters/*.php'),
]);

return new Container($aggregator->getMergedConfig());
