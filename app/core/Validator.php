<?php

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {

            $value = $data[$field] ?? '';

            foreach ($fieldRules as $rule) {

                if ($rule === 'required' && empty(trim($value))) {
                    $this->errors[$field][] = "Champ requis";
                }

                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "Email invalide";
                }

                if ($rule === 'alpha' && !preg_match('/^[a-zA-ZÀ-ÿ\s-]+$/', $value)) {
                    $this->errors[$field][] = "Caractères invalides";
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
?>
