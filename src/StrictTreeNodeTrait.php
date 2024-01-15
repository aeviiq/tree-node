<?php

declare(strict_types=1);

namespace Aeviiq\TreeNode;

use Aeviiq\TreeNode\Exception\InvalidArgumentException;

trait StrictTreeNodeTrait
{
    use TreeNodeTrait {
        setParent as private setTreeNodeParent;
        addChild as private addTreeNodeChild;
    }

    public function setParent(?TreeNodeInterface $parent): void
    {
        if (null !== $parent) {
            $this->guardTreeNodeType($parent);
        }

        $this->setTreeNodeParent($parent);
    }

    public function addChild(TreeNodeInterface $child): void
    {
        $this->guardTreeNodeType($child);
        $this->addTreeNodeChild($child);
    }

    /**
     * @return string The class|interface name of the allowed instance.
     */
    abstract protected function getAllowedInstance(): string;

    /**
     * @throws InvalidArgumentException When the given tree node is not of the allowed instance.
     */
    private function guardTreeNodeType(TreeNodeInterface $treeNode): void
    {
        if (!\is_a($treeNode, $allowed = $this->getAllowedInstance())) {
            throw new InvalidArgumentException(\sprintf('Tree node must be of type "%s", "%s" given.', $allowed, \get_class($treeNode)));
        }
    }
}
