<?php

declare(strict_types=1);

namespace Aeviiq\TreeNode;

trait TreeNodeTrait
{
    /**
     * @var TreeNodeInterface|null
     */
    private $parent;

    /**
     * @var TreeNodeCollection
     */
    private $children;

    public function isRoot(): bool
    {
        return null === $this->getParent();
    }

    public function getRoot(): TreeNodeInterface
    {
        if (null !== $parent = $this->getParent()) {
            return $parent->getRoot();
        }

        return $this;
    }

    public function isLeaf(): bool
    {
        return !$this->isRoot() && $this->getChildren()->isEmpty();
    }

    public function getParent(): ?TreeNodeInterface
    {
        return $this->parent;
    }

    public function setParent(?TreeNodeInterface $parent): void
    {
        if ($this === $parent) {
            throw new \LogicException('A node cannot be a parent of itself.');
        }

        $currentParent = $this->getParent();
        if ($currentParent === $parent) {
            return;
        }

        if (null !== $currentParent && $currentParent->hasChild($this)) {
            $currentParent->removeChild($this);
        }

        if (null !== $parent && !$parent->hasChild($this)) {
            $parent->addChild($this);
        }

        $this->parent = $parent;
    }

    public function getChildren(): TreeNodeCollection
    {
        if (null === $this->children) {
            $this->children = new  TreeNodeCollection();
        }

        return $this->children;
    }

    public function addChild(TreeNodeInterface $child): void
    {
        if ($this === $child) {
            throw new \LogicException('A node cannot be a child of itself.');
        }

        if ($this->hasChild($child)) {
            return;
        }

        $this->getChildren()->append($child);
        $child->setParent($this);
    }

    public function hasChild(TreeNodeInterface $child): bool
    {
        return $this->getChildren()->contains($child);
    }

    public function removeChild(TreeNodeInterface $child): void
    {
        if (!$this->hasChild($child)) {
            return;
        }

        $this->getChildren()->remove($child);
        $child->setParent(null);
    }

    public function clearChildren(): void
    {
        $children = $this->getChildren();
        foreach ($children as $child) {
            $child->setParent(null);
        }

        $children->clear();
    }
}
