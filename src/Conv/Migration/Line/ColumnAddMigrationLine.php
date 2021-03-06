<?php

namespace Conv\Migration\Line;

use Conv\Structure\ModifiedColumnStructure;

/**
 * ALTER TABLE ~ ADD ~
 */
class ColumnAddMigrationLine extends AbstractMigrationLine
{
    /**
     * @param ModifiedColumnStructure[] $modifiedColumnList
     */
    public function __construct(
        array $modifiedColumnList
    ) {
        foreach ($modifiedColumnList as $modifiedColumn) {
            $this->upLineList[] = $modifiedColumn->generateAddQuery();
            $this->downLineList[] = $modifiedColumn->getColumn()->generateDropQuery();
        }
    }
}
