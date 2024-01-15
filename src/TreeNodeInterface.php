<?php

declare(strict_types=1);

namespace Aeviiq\TreeNode;

interface TreeNodeInterface
{
    public function isRoot(): bool;

    public function getRoot(): TreeNodeInterface;

    public function isLeaf(): bool;

    public function getParent(): ?TreeNodeInterface;

    public function setParent(?TreeNodeInterface $parent): void;

    public function getChildren(): TreeNodeCollection;

    public function addChild(TreeNodeInterface $child): void;

    public function hasChild(TreeNodeInterface $child): bool;

    public function removeChild(TreeNodeInterface $child): void;

    public function clearChildren(): void;
}
