<?php

test('lists students', function () {
    \App\Models\Student::factory()->count(2)->create();

    $r = $this->getJson('/api/students');
    $r->assertStatus(200)->assertJsonStructure(['data']);
});

test('creates a student', function () {
    $payload = [
        'student_number' => '123456',
        'given_name' => 'Alex',
        'family_name' => 'Kim',
        'email' => 'alex.kim@example.com'
    ];
    $r = $this->postJson('/api/students', $payload);
    $r->assertStatus(201)->assertHeader('Location');
});
