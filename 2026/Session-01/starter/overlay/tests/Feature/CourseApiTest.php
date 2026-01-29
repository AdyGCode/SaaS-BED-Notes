<?php

test('lists courses', function () {
    \App\Models\Course::factory()->count(2)->create();

    $r = $this->getJson('/api/courses');
    $r->assertStatus(200)->assertJsonStructure(['data']);
});

test('shows one course', function () {
    $c = \App\Models\Course::factory()->create();

    $r = $this->getJson('/api/courses/' . $c->id);
    $r->assertStatus(200)->assertJsonPath('data.id', $c->id);
});

test('creates a course', function () {
    $payload = ['code' => 'BED101', 'title' => 'Backend Basics'];
    $r = $this->postJson('/api/courses', $payload);

    $r->assertStatus(201)
      ->assertHeader('Location')
      ->assertJsonPath('data.code', 'BED101');
});

test('validates course create', function () {
    $r = $this->postJson('/api/courses', ['code' => '', 'title' => '']);
    $r->assertStatus(422);
});
