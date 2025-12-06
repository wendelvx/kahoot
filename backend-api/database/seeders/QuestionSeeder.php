<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Option;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Limpa as tabelas antes de rodar (Segurança tática)
        // Question::truncate(); 
        // Option::truncate();

        $questions = [
            [
                'question_text' => 'O conceito de ESTRATÉGIA, em grego, significa "stratègia". No Laravel, qual é a estratégia para evitar o Problema N+1?',
                'options' => [
                    ['option_text' => 'Rezar para o servidor aguentar o tranco', 'is_correct' => false],
                    ['option_text' => 'Usar Eager Loading (with). Quem faz query dentro de loop é um fanfarrão!', 'is_correct' => true],
                    ['option_text' => 'Aumentar a memória do PHP no servidor', 'is_correct' => false],
                    ['option_text' => 'Culpar o estagiário 06', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Aspira, você rodou "php artisan migrate:fresh" em produção. Qual é a situação?',
                'options' => [
                    ['option_text' => 'O sistema ficou mais rápido', 'is_correct' => false],
                    ['option_text' => 'Você acabou de apagar o banco de dados inteiro. Pede pra sair!', 'is_correct' => true],
                    ['option_text' => 'Nada, o Laravel protege contra burrice nativa', 'is_correct' => false],
                    ['option_text' => 'Você ganhou uma promoção', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'No Vue.js, o que acontece se o senhor tentar alterar uma "Prop" diretamente no componente filho?',
                'options' => [
                    ['option_text' => 'O Vue vai te dar um aviso no console vermelho sangue. Hierarquia é tudo!', 'is_correct' => true],
                    ['option_text' => 'Funciona, mas é tática de guerrilha', 'is_correct' => false],
                    ['option_text' => 'O componente pai pede demissão', 'is_correct' => false],
                    ['option_text' => 'Nada, aqui é terra sem lei', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Qual é a função de um Middleware nas rotas do Laravel?',
                'options' => [
                    ['option_text' => 'Enfeitar o código', 'is_correct' => false],
                    ['option_text' => 'Deixar o sistema lento de propósito', 'is_correct' => false],
                    ['option_text' => 'É o porteiro do quartel. Se não tiver autorização (Token), não passa da guarita.', 'is_correct' => true],
                    ['option_text' => 'Servir café para o Controller', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor comitou a senha do banco de dados no GitHub público. O que o senhor é?',
                'options' => [
                    ['option_text' => 'Um desenvolvedor proativo', 'is_correct' => false],
                    ['option_text' => 'Um X-9 cibernético', 'is_correct' => false],
                    ['option_text' => 'Um bizonho que não sabe usar o .env e o .gitignore', 'is_correct' => true],
                    ['option_text' => 'Um gênio da criptografia', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Para que serve a "Composition API" no Vue 3, 06?',
                'options' => [
                    ['option_text' => 'Para confundir a cabeça de quem usava Options API', 'is_correct' => false],
                    ['option_text' => 'Para organizar a lógica por funcionalidade e reutilizar código com disciplina militar', 'is_correct' => true],
                    ['option_text' => 'Para compor músicas enquanto coda', 'is_correct' => false],
                    ['option_text' => 'É uma API para desenhar na tela', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que significa erro de CORS no console do navegador?',
                'options' => [
                    ['option_text' => 'O navegador barrou sua requisição porque você não tem permissão pra entrar nessa favela.', 'is_correct' => true],
                    ['option_text' => 'Coração Operacional Requisitando Socorro', 'is_correct' => false],
                    ['option_text' => 'Sua internet caiu', 'is_correct' => false],
                    ['option_text' => 'O backend está de greve', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Qual a diferença entre v-if e v-show? Responda rápido!',
                'options' => [
                    ['option_text' => 'São iguais, o senhor está inventando moda', 'is_correct' => false],
                    ['option_text' => 'v-show esconde com CSS. v-if arranca o elemento do DOM sem piedade (saco preto).', 'is_correct' => true],
                    ['option_text' => 'v-if é para indecisos', 'is_correct' => false],
                    ['option_text' => 'v-show consome mais munição (memória)', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é um "Full Stack Developer" na visão do comando?',
                'options' => [
                    ['option_text' => 'Alguém que resolve o BO no front e na retaguarda (back). Operador completo.', 'is_correct' => true],
                    ['option_text' => 'Alguém que não sabe nada de nada', 'is_correct' => false],
                    ['option_text' => 'Um mito urbano', 'is_correct' => false],
                    ['option_text' => 'Quem sabe centralizar div e criar tabela no banco', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Fazer deploy na sexta-feira às 18h é:',
                'options' => [
                    ['option_text' => 'Coragem', 'is_correct' => false],
                    ['option_text' => 'Burrice tática. Vai passar o fim de semana no quartel corrigindo bug.', 'is_correct' => true],
                    ['option_text' => 'Estratégia para ganhar hora extra', 'is_correct' => false],
                    ['option_text' => 'Obrigação do estagiário', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor fez um "git push --force" na branch main. Qual é a sua sentença?',
                'options' => [
                    ['option_text' => 'Corte marcial e perda da patente de desenvolvedor', 'is_correct' => true],
                    ['option_text' => 'Nada, eu sou o dono do repositório', 'is_correct' => false],
                    ['option_text' => 'Ganho um aumento pela audácia', 'is_correct' => false],
                    ['option_text' => 'O Git resolve tudo sozinho', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é um "Null Pointer Exception" (ou tentar acessar propriedade de null)?',
                'options' => [
                    ['option_text' => 'É quando o ponteiro do mouse quebra', 'is_correct' => false],
                    ['option_text' => 'É o erro de quem não verifica se a variável existe. Amadorismo, 06!', 'is_correct' => true],
                    ['option_text' => 'É um recurso avançado do PHP', 'is_correct' => false],
                    ['option_text' => 'É culpa do usuário', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'No Laravel, para que serve a propriedade $fillable no Model?',
                'options' => [
                    ['option_text' => 'Para encher linguiça no código', 'is_correct' => false],
                    ['option_text' => 'Para decorar a classe', 'is_correct' => false],
                    ['option_text' => 'Segurança Tática. Define quem entra e quem fica de fora no Mass Assignment.', 'is_correct' => true],
                    ['option_text' => 'Para deixar o banco mais rápido', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor usou GET para deletar um registro via API. O que o senhor é?',
                'options' => [
                    ['option_text' => 'Um inovador', 'is_correct' => false],
                    ['option_text' => 'Um perigo para a sociedade. DELETE é DELETE, aspira!', 'is_correct' => true],
                    ['option_text' => 'Um hacker', 'is_correct' => false],
                    ['option_text' => 'Um otimizador de rotas', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Qual a diferença entre "computed" e "methods" no Vue.js?',
                'options' => [
                    ['option_text' => 'Computed tem cache, é inteligente. Method roda toda vez, gasta munição à toa.', 'is_correct' => true],
                    ['option_text' => 'Nenhuma, é tudo JavaScript', 'is_correct' => false],
                    ['option_text' => 'Methods são só para cliques', 'is_correct' => false],
                    ['option_text' => 'Computed é para fazer contas de matemática', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que significa SQL Injection?',
                'options' => [
                    ['option_text' => 'Uma vacina para o banco de dados', 'is_correct' => false],
                    ['option_text' => 'Quando o banco injeta dados no front', 'is_correct' => false],
                    ['option_text' => 'Quando você deixa a porta aberta pro inimigo rodar comandos no seu banco. Falha de segurança grave!', 'is_correct' => true],
                    ['option_text' => 'Um tipo de join avançado', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O cliente pediu pra mudar o escopo na sexta-feira à tarde. Qual a resposta padrão?',
                'options' => [
                    ['option_text' => '"Claro, faço agora mesmo"', 'is_correct' => false],
                    ['option_text' => '"Negativo. O planejamento é sagrado. Segunda-feira conversamos."', 'is_correct' => true],
                    ['option_text' => '"Vou chorar no banheiro"', 'is_correct' => false],
                    ['option_text' => '"Só se pagar o dobro"', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Para que serve o comando "composer install"?',
                'options' => [
                    ['option_text' => 'Para compor uma música', 'is_correct' => false],
                    ['option_text' => 'Para instalar o Windows', 'is_correct' => false],
                    ['option_text' => 'Para baixar os reforços (dependências) que sua aplicação precisa pra ficar de pé.', 'is_correct' => true],
                    ['option_text' => 'Para formatar o PC', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é um Status Code 500?',
                'options' => [
                    ['option_text' => 'Sucesso total', 'is_correct' => false],
                    ['option_text' => 'Não encontrado', 'is_correct' => false],
                    ['option_text' => 'Erro interno do servidor. O backend pediu pra sair!', 'is_correct' => true],
                    ['option_text' => 'Redirecionamento tático', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor escreveu 500 linhas de código e não criou nenhum teste unitário. Qual sua justificativa?',
                'options' => [
                    ['option_text' => '"Eu confio no meu código"', 'is_correct' => false],
                    ['option_text' => '"Testar é para os fracos"', 'is_correct' => false],
                    ['option_text' => 'Não há justificativa. O senhor é um irresponsável e vai refazer tudo com TDD!', 'is_correct' => true],
                    ['option_text' => '"O QA que se vire"', 'is_correct' => false],
                ]
            ],
            // --- REFORÇO DE MUNIÇÃO (NOVAS QUESTÕES) ---
            
            [
                'question_text' => 'O senhor encontrou um conflito no git merge. O que o senhor faz?',
                'options' => [
                    ['option_text' => 'Chora no banheiro', 'is_correct' => false],
                    ['option_text' => 'Resolve conflito na mão, linha por linha. O senhor é cirurgião de código ou açougueiro?', 'is_correct' => true],
                    ['option_text' => 'Apaga a branch e finge demência', 'is_correct' => false],
                    ['option_text' => 'Dá force push e apaga o trabalho da equipe', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Usar "!important" em todas as regras de CSS é tática de quem?',
                'options' => [
                    ['option_text' => 'De quem tem total controle da especificidade', 'is_correct' => false],
                    ['option_text' => 'De quem desistiu da vida', 'is_correct' => false],
                    ['option_text' => 'De sabotador! Quem quebra a cascata não merece a farda!', 'is_correct' => true],
                    ['option_text' => 'Do Senior Frontend', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que acontece quando você roda "composer update" no servidor de produção na sexta-feira?',
                'options' => [
                    ['option_text' => 'O sistema fica mais seguro', 'is_correct' => false],
                    ['option_text' => 'Você brinca de roleta russa com 6 balas no tambor. É pedir pra dar tela branca!', 'is_correct' => true],
                    ['option_text' => 'As dependências agradecem', 'is_correct' => false],
                    ['option_text' => 'O cliente manda flores', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O estagiário subiu uma imagem de 5MB direto na home do site. Qual a consequência?',
                'options' => [
                    ['option_text' => 'O site fica em HD, muito bom', 'is_correct' => false],
                    ['option_text' => 'O 4G do usuário morre e o senhor vai preso por homicídio de banda!', 'is_correct' => true],
                    ['option_text' => 'O Google rankeia melhor', 'is_correct' => false],
                    ['option_text' => 'Nenhuma, hoje a internet é rápida', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'No TypeScript, o senhor definiu todas as variáveis como "any". O que isso significa?',
                'options' => [
                    ['option_text' => 'Flexibilidade tática', 'is_correct' => false],
                    ['option_text' => 'Que o senhor tem medo de tipagem. Isso é covardia, 06!', 'is_correct' => true],
                    ['option_text' => 'Código limpo', 'is_correct' => false],
                    ['option_text' => 'Produtividade máxima', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Sua API retorna status 200 (OK), mas o JSON contém {"error": "Internal Server Error"}. O que é isso?',
                'options' => [
                    ['option_text' => 'Uma API RESTful', 'is_correct' => false],
                    ['option_text' => 'Psicopatia. O senhor está enganando o cliente HTTP!', 'is_correct' => true],
                    ['option_text' => 'Uma feature de segurança', 'is_correct' => false],
                    ['option_text' => 'O padrão do mercado', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor comentou o teste unitário que estava falhando para o pipeline passar. O que o senhor cometeu?',
                'options' => [
                    ['option_text' => 'Falsidade ideológica e crime de guerra contra a qualidade!', 'is_correct' => true],
                    ['option_text' => 'Otimização de tempo', 'is_correct' => false],
                    ['option_text' => 'Estratégia ágil', 'is_correct' => false],
                    ['option_text' => 'Um pequeno ajuste técnico', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Para que serve a "pasta vendor" no Laravel?',
                'options' => [
                    ['option_text' => 'Para ser versionada no Git', 'is_correct' => false],
                    ['option_text' => 'É onde a magia negra habita. Nunca toque nela, ou ela toca em você.', 'is_correct' => true],
                    ['option_text' => 'Para salvar uploads de usuários', 'is_correct' => false],
                    ['option_text' => 'Para colocar seus controllers', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é um "Memory Leak" no frontend?',
                'options' => [
                    ['option_text' => 'Quando o computador sua frio', 'is_correct' => false],
                    ['option_text' => 'É deixar a torneira aberta. O browser do cliente vai travar e a culpa é sua!', 'is_correct' => true],
                    ['option_text' => 'Uma nova feature do React', 'is_correct' => false],
                    ['option_text' => 'Vazamento de dados confidenciais', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Você está usando "console.log" para debugar em produção. Qual o diagnóstico?',
                'options' => [
                    ['option_text' => 'Amadorismo. O senhor está sujando o console do cliente!', 'is_correct' => true],
                    ['option_text' => 'Transparência total', 'is_correct' => false],
                    ['option_text' => 'Debug avançado', 'is_correct' => false],
                    ['option_text' => 'É para o usuário saber o que está acontecendo', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é Docker?',
                'options' => [
                    ['option_text' => 'Uma marca de calças', 'is_correct' => false],
                    ['option_text' => 'É o contêiner tático. Se funciona na minha máquina, funciona na do senhor também!', 'is_correct' => true],
                    ['option_text' => 'Um vírus que come memória RAM', 'is_correct' => false],
                    ['option_text' => 'Um editor de texto', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que significa a sigla "MVP"?',
                'options' => [
                    ['option_text' => 'Muito Vai Piorar', 'is_correct' => false],
                    ['option_text' => 'Minimum Viable Product. O básico para a missão não fracassar.', 'is_correct' => true],
                    ['option_text' => 'Most Valuable Player', 'is_correct' => false],
                    ['option_text' => 'Mais Vale Programar', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Qual a função do "v-for" sem a "key" no Vue.js?',
                'options' => [
                    ['option_text' => 'Gerar caos na renderização. O Vue fica perdido igual barata tonta!', 'is_correct' => true],
                    ['option_text' => 'Economizar bytes', 'is_correct' => false],
                    ['option_text' => 'Não serve para nada', 'is_correct' => false],
                    ['option_text' => 'É opcional, igual testar', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor nomeou a variável como "$x". O que "$x" armazena?',
                'options' => [
                    ['option_text' => 'A coordenada do mapa', 'is_correct' => false],
                    ['option_text' => 'Ninguém sabe, nem o senhor daqui a 2 dias. Nomeie direito essa variável, 06!', 'is_correct' => true],
                    ['option_text' => 'O fator X', 'is_correct' => false],
                    ['option_text' => 'Um número aleatório', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que é um "Magic Number" no código?',
                'options' => [
                    ['option_text' => 'Um número da sorte', 'is_correct' => false],
                    ['option_text' => 'Um número solto sem explicação. O senhor acha que eu sou adivinho?', 'is_correct' => true],
                    ['option_text' => 'O ID do admin', 'is_correct' => false],
                    ['option_text' => '3.14', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Quando o Tech Lead pergunta "Como está o andamento?", o que você NÃO responde?',
                'options' => [
                    ['option_text' => '"Está 90% pronto"', 'is_correct' => false],
                    ['option_text' => '"Só falta testar"', 'is_correct' => false],
                    ['option_text' => '"Na minha máquina funciona"', 'is_correct' => false],
                    ['option_text' => 'Todas as alternativas acima. O senhor traz resultados, não desculpas!', 'is_correct' => true],
                ]
            ],
            [
                'question_text' => 'O que é "Callback Hell"?',
                'options' => [
                    ['option_text' => 'Uma música do AC/DC', 'is_correct' => false],
                    ['option_text' => 'Um código tão indentado que parece uma escada para o inferno. Use Async/Await, soldado!', 'is_correct' => true],
                    ['option_text' => 'Quando o cliente liga de volta', 'is_correct' => false],
                    ['option_text' => 'Uma função recursiva', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Qual a estratégia correta para lidar com senhas no banco de dados?',
                'options' => [
                    ['option_text' => 'Salvar em texto puro para lembrar depois', 'is_correct' => false],
                    ['option_text' => 'Hashing com Bcrypt ou Argon2. Segurança não é brincadeira, aspira!', 'is_correct' => true],
                    ['option_text' => 'Base64', 'is_correct' => false],
                    ['option_text' => 'Salvar num post-it no monitor', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O que o comando "git blame" revela?',
                'options' => [
                    ['option_text' => 'A verdade nua e crua. Quem fez a besteira assina embaixo!', 'is_correct' => true],
                    ['option_text' => 'Quem é o culpado pelo aquecimento global', 'is_correct' => false],
                    ['option_text' => 'O histórico do navegador', 'is_correct' => false],
                    ['option_text' => 'Nada, é fofoca', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'O senhor vai fazer o deploy sem backup do banco. O que o senhor tem na cabeça?',
                'options' => [
                    ['option_text' => 'Coragem', 'is_correct' => false],
                    ['option_text' => 'Vento? O senhor quer derrubar a operação inteira?', 'is_correct' => true],
                    ['option_text' => 'Fé', 'is_correct' => false],
                    ['option_text' => 'Confiança no ORM', 'is_correct' => false],
                ]
            ],
        ];
        
        
        foreach ($questions as $qData) {
            $question = Question::create([
                'question_text' => $qData['question_text']
            ]);

            foreach ($qData['options'] as $optData) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optData['option_text'],
                    'is_correct'  => $optData['is_correct']
                ]);
            }
        }
    }
}