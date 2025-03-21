<?php

declare(strict_types=1);

namespace OpenTelemetry\Tests\Unit\SDK\Trace;

use AssertWell\PHPUnitGlobalState\EnvironmentVariables;
use InvalidArgumentException;
use OpenTelemetry\SDK\Trace\SpanExporterInterface;
use OpenTelemetry\SDK\Trace\SpanProcessor\BatchSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanProcessor\NoopSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanProcessorFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers OpenTelemetry\SDK\Trace\SpanProcessorFactory
 */
class SpanProcessorFactoryTest extends TestCase
{
    use EnvironmentVariables;

    protected function tearDown(): void
    {
        $this->restoreEnvironmentVariables();
    }

    /**
     * @dataProvider processorProvider
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function test_span_processor_factory_create_span_processor_from_environment(string $processorName, string $expected): void
    {
        $this->setEnvironmentVariable('OTEL_PHP_TRACES_PROCESSOR', $processorName);
        $factory = new SpanProcessorFactory();
        $this->assertInstanceOf($expected, $factory->fromEnvironment());
    }

    public function processorProvider()
    {
        return [
            'batch' => ['batch', BatchSpanProcessor::class],
            'simple' => ['simple', SimpleSpanProcessor::class],
            'noop' => ['noop', NoopSpanProcessor::class],
        ];
    }
    /**
     * @dataProvider invalidProcessorProvider
     */
    public function test_span_processor_factory_invalid_span_processor(?string $processor): void
    {
        $this->setEnvironmentVariable('OTEL_PHP_TRACES_PROCESSOR', $processor);
        $factory = new SpanProcessorFactory();
        $exporter = $this->createMock(SpanExporterInterface::class);
        $this->expectException(InvalidArgumentException::class);
        $factory->fromEnvironment($exporter);
    }

    public function invalidProcessorProvider()
    {
        return [
            'not set' => [null],
            'invalid processor' => ['foo'],
        ];
    }
}
