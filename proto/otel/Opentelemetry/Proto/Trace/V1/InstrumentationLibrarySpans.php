<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: opentelemetry/proto/trace/v1/trace.proto

namespace Opentelemetry\Proto\Trace\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A collection of Spans produced by an InstrumentationLibrary.
 *
 * Generated from protobuf message <code>opentelemetry.proto.trace.v1.InstrumentationLibrarySpans</code>
 */
class InstrumentationLibrarySpans extends \Google\Protobuf\Internal\Message
{
    /**
     * The instrumentation library information for the spans in this message.
     * Semantically when InstrumentationLibrary isn't set, it is equivalent with
     * an empty instrumentation library name (unknown).
     *
     * Generated from protobuf field <code>.opentelemetry.proto.common.v1.InstrumentationLibrary instrumentation_library = 1;</code>
     */
    private $instrumentation_library = null;
    /**
     * A list of Spans that originate from an instrumentation library.
     *
     * Generated from protobuf field <code>repeated .opentelemetry.proto.trace.v1.Span spans = 2;</code>
     */
    private $spans;
    /**
     * This schema_url applies to all spans and span events in the "spans" field.
     *
     * Generated from protobuf field <code>string schema_url = 3;</code>
     */
    private $schema_url = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Opentelemetry\Proto\Common\V1\InstrumentationLibrary $instrumentation_library
     *           The instrumentation library information for the spans in this message.
     *           Semantically when InstrumentationLibrary isn't set, it is equivalent with
     *           an empty instrumentation library name (unknown).
     *     @type \Opentelemetry\Proto\Trace\V1\Span[]|\Google\Protobuf\Internal\RepeatedField $spans
     *           A list of Spans that originate from an instrumentation library.
     *     @type string $schema_url
     *           This schema_url applies to all spans and span events in the "spans" field.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Opentelemetry\Proto\Trace\V1\Trace::initOnce();
        parent::__construct($data);
    }

    /**
     * The instrumentation library information for the spans in this message.
     * Semantically when InstrumentationLibrary isn't set, it is equivalent with
     * an empty instrumentation library name (unknown).
     *
     * Generated from protobuf field <code>.opentelemetry.proto.common.v1.InstrumentationLibrary instrumentation_library = 1;</code>
     * @return \Opentelemetry\Proto\Common\V1\InstrumentationLibrary
     */
    public function getInstrumentationLibrary()
    {
        return $this->instrumentation_library;
    }

    /**
     * The instrumentation library information for the spans in this message.
     * Semantically when InstrumentationLibrary isn't set, it is equivalent with
     * an empty instrumentation library name (unknown).
     *
     * Generated from protobuf field <code>.opentelemetry.proto.common.v1.InstrumentationLibrary instrumentation_library = 1;</code>
     * @param \Opentelemetry\Proto\Common\V1\InstrumentationLibrary $var
     * @return $this
     */
    public function setInstrumentationLibrary($var)
    {
        GPBUtil::checkMessage($var, \Opentelemetry\Proto\Common\V1\InstrumentationLibrary::class);
        $this->instrumentation_library = $var;

        return $this;
    }

    /**
     * A list of Spans that originate from an instrumentation library.
     *
     * Generated from protobuf field <code>repeated .opentelemetry.proto.trace.v1.Span spans = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSpans()
    {
        return $this->spans;
    }

    /**
     * A list of Spans that originate from an instrumentation library.
     *
     * Generated from protobuf field <code>repeated .opentelemetry.proto.trace.v1.Span spans = 2;</code>
     * @param \Opentelemetry\Proto\Trace\V1\Span[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSpans($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Opentelemetry\Proto\Trace\V1\Span::class);
        $this->spans = $arr;

        return $this;
    }

    /**
     * This schema_url applies to all spans and span events in the "spans" field.
     *
     * Generated from protobuf field <code>string schema_url = 3;</code>
     * @return string
     */
    public function getSchemaUrl()
    {
        return $this->schema_url;
    }

    /**
     * This schema_url applies to all spans and span events in the "spans" field.
     *
     * Generated from protobuf field <code>string schema_url = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSchemaUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->schema_url = $var;

        return $this;
    }

}

