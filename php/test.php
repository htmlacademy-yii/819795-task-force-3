<?php

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

include 'Task.php';

$task = new Task(1);

$task->setExecutor(3);

print_r($task);

print_r($task->getAllowedActions(3));

assert($task->getNextStatus('action_respond') == Task::STATUS_NEW, 'respond action');
