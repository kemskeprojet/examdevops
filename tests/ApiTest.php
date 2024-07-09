<?php
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private $base_url = 'http://localhost/php/api.php';

    public function testGetTasks()
    {
        $response = file_get_contents($this->base_url);
        $tasks = json_decode($response, true);

        $this->assertIsArray($tasks);
        $this->assertGreaterThanOrEqual(0, count($tasks));
    }

    public function testCreateTask()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'status' => 'pending'
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->base_url, false, $context);
        $result = json_decode($response, true);

        $this->assertEquals('Task created successfully', $result['message'] ?? '');
    }
}
