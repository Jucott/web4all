SELECT
    conname AS constraint_name,
    pg_catalog.pg_get_constraintdef(c.oid, true) AS constraint_definition,
    contype AS constraint_type
FROM
    pg_catalog.pg_constraint c
JOIN
    pg_catalog.pg_class rel ON rel.oid = c.conrelid
JOIN
    pg_catalog.pg_namespace nsp ON nsp.oid = rel.relnamespace
WHERE
    nsp.nspname = 'public'
    AND rel.relname = 'permission';
