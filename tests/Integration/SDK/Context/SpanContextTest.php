<?php

declare(strict_types=1);

namespace OpenTelemetry\Tests\Integration\SDK\Context;

use OpenTelemetry\API\Trace as API;
use OpenTelemetry\API\Trace\SpanContext;
use OpenTelemetry\API\Trace\TraceState;
use OpenTelemetry\SDK\Trace\RandomIdGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class SpanContextTest extends TestCase
{
    /**
     * @dataProvider invalidSpanData
     */
    public function test_invalid_span(string $traceId, string $spanId): void
    {
        $spanContext = SpanContext::create($traceId, $spanId);
        $this->assertSame(SpanContext::INVALID_TRACE, $spanContext->getTraceId());
        $this->assertSame(SpanContext::INVALID_SPAN, $spanContext->getSpanId());
    }

    public function invalidSpanData(): array
    {
        return [
            // Too long TraceID
            ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa36', 'bbbbbbbbbbbbbb16', '/^TraceID/'],
            // Too long SpanID
            ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa32', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbb32', '/^SpanID/'],
            // Bad characters in TraceID
            ['bad trace', 'bbbbbbbbbbbbbb16', '/^TraceID/'],
            // Bad characters in SpanID
            ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa32', 'bad span', '/^SpanID/'],
        ];
    }

    public function test_valid_span(): void
    {
        $spanContext = SpanContext::create('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbb', API\SpanContextInterface::TRACE_FLAG_SAMPLED);
        $this->assertTrue($spanContext->isValid());
    }

    public function test_context_is_remote_from_restore(): void
    {
        $spanContext = SpanContext::createFromRemoteParent('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbb', API\SpanContextInterface::TRACE_FLAG_SAMPLED);
        $this->assertTrue($spanContext->isRemote());
    }

    public function test_context_is_not_remote_from_constructor(): void
    {
        $spanContext = SpanContext::create('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbb', API\SpanContextInterface::TRACE_FLAG_SAMPLED);
        $this->assertFalse($spanContext->isRemote());
    }

    public function test_sampled_span(): void
    {
        $spanContext = SpanContext::create('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbb', API\SpanContextInterface::TRACE_FLAG_SAMPLED);
        $this->assertTrue($spanContext->isSampled());
    }

    public function test_getters_work(): void
    {
        $trace = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $span = 'bbbbbbbbbbbbbbbb';
        $tracestate = new TraceState('a=b');
        $spanContext = SpanContext::create($trace, $span, API\SpanContextInterface::TRACE_FLAG_DEFAULT, $tracestate);
        $this->assertSame($trace, $spanContext->getTraceId());
        $this->assertSame($span, $spanContext->getSpanId());
        $this->assertSame($tracestate, $spanContext->getTraceState());
        $this->assertFalse($spanContext->isSampled());
    }

    public function test_random_generated_ids_create_valid_context(): void
    {
        $idGenerator = new RandomIdGenerator();
        $context = SpanContext::create($idGenerator->generateTraceId(), $idGenerator->generateSpanId(), 0);
        $this->assertTrue($context->isValid());
    }
}
