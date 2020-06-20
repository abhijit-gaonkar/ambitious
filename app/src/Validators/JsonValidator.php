<?php

namespace Ambitious\Core\Validators;

use JsonSchema;

class JsonValidator
{
    /** @var JsonSchema\Validator  */
    private $validator;

    /** @var \stdClass */
    private $decoded;

    public function __construct()
    {
        $this->validator = new JsonSchema\Validator();
    }

    /**
     * @param string                 $schemaLocation
     * @param string|array|\stdClass $json
     *
     * @return bool
     */
    public function validate($schemaLocation, $json)
    {
        $retriever = new JsonSchema\Uri\UriRetriever();

        if (file_exists($schemaLocation)){
            $schemaName = realpath($schemaLocation);
        } else {
            $schemaName = realpath(INSTALL_ROOT . '/www/middleware/helpers/schemas' . $schemaLocation);
        }

        $schema = $retriever->retrieve('file://' . $schemaName);

        // JsonSchema\Validator needs the decoded json as stdClass, hence $assoc = false
        switch (true) {
            case is_array($json):

                $this->decoded = (object) $json;
                break;

            case is_string($json):

                $this->decoded = json_decode($json, false);
                break;

            case $json instanceof \stdClass:

                $this->decoded = $json;
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Invalid type for $json'));
        }

        $refResolver = new JsonSchema\RefResolver($retriever);
        $refResolver->resolve($schema);

        $this->validator->check($this->decoded, $schema);

        return $this->validator->isValid();
    }

    public function getErrors()
    {
        return $this->validator->getErrors();
    }

    public function getDecoded() {
        return json_decode(json_encode($this->decoded), true);
    }
}
