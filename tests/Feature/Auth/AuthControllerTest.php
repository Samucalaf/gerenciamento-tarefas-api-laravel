<?php 

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Nette\Utils\Json;

class AuthControllerTest extends TestCase {

    use RefreshDatabase;
    public function test_usuario_nao_pode_registrar_com_email_existente(){
        $user = User::factory()->create([
            'name' => 'testando',
            'email' => 'emailExits@gmail.com',
            'password' => 'Lafuente95'
        ]);

        $response = $this->post('http://localhost:8000/api/auth/register', [
            'name' => 'testando',
            'email' => 'emailExits@gmail.com',
            'password' => 'Lafuente95'
        ]);
        

        $response->assertStatus(401);
        
    }

}