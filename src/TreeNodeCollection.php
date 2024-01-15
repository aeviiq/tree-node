<?php

declare(strict_types=1);

namespace Aeviiq\TreeNode;

use Aeviiq\Collection\ObjectCollection;

/**
 * @method \ArrayIterator|TreeNodeInterface[] getIterator
 * @method TreeNodeInterface|null first
 * @method TreeNodeInterface|null last
 */
final class TreeNodeCollection extends ObjectCollection
{
    protected function allowedInstance(): string
    {
        return TreeNodeInterface::class;
    }
}
