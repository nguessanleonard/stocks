<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class GithubWebhookController extends Controller
    {
        public function deploy(Request $request)
        {
            $secret = 'MON_SECRET_GITHUB';

            if ($request->header('X-Hub-Signature-256')) {

                $signature = 'sha256=' . hash_hmac(
                        'sha256',
                        $request->getContent(),
                        $secret
                    );

                if (!hash_equals($signature, $request->header('X-Hub-Signature-256'))) {
                    abort(403, 'Signature invalide');
                }
            }

            chdir('/home/sgiinphb/public_html/test.sgi.inphb.app');

            exec('git pull origin main 2>&1', $output1);
            exec('php artisan optimize:clear 2>&1', $output2);
            exec('php artisan optimize 2>&1', $output3);

            return response()->json([
                'success' => true,
                'git' => $output1,
                'clear' => $output2,
                'optimize' => $output3
            ]);
        }
    }
