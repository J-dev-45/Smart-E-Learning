import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpServer;
import javax.tools.JavaCompiler;
import javax.tools.ToolProvider;
import java.io.*;
import java.net.InetSocketAddress;
import java.nio.charset.StandardCharsets;
import java.nio.file.*;
import java.util.concurrent.Executors;
import java.util.regex.Pattern;

public class CompilerServer {
    private static final int PORT = 8080;
    private static final Path BASE_DIR =
        Paths.get("/app/storage/app/compiler");

    private static final Pattern JOB_ID_PATTERN =
        Pattern.compile("[A-Za-z0-9_-]+");

    private static JavaCompiler compiler;

    public static void main(String[] args) throws Exception {
        Files.createDirectories(BASE_DIR);

        compiler = ToolProvider.getSystemJavaCompiler();

        if (compiler == null) {
            throw new IllegalStateException(
                "Java compiler is unavailable."
            );
        }

        System.out.println(
            "Java compiler service starting..."
        );

        HttpServer server = HttpServer.create(
            new InetSocketAddress("0.0.0.0", PORT),
            0
        );

        server.createContext(
            "/compile",
            CompilerServer::compile
        );

        server.setExecutor(
            Executors.newFixedThreadPool(2)
        );

        server.start();

        System.out.println(
            "Java compiler service running on port " + PORT
        );
    }

    private static void compile(
        HttpExchange exchange
    ) throws IOException {

        if (!"POST".equalsIgnoreCase(
            exchange.getRequestMethod()
        )) {
            send(
                exchange,
                405,
                "Method Not Allowed"
            );
            return;
        }

        String requestBody = new String(
            exchange.getRequestBody().readAllBytes(),
            StandardCharsets.UTF_8
        );

        String[] parts = requestBody.split(
            "\\n---JOB---\\n",
            2
        );

        if (parts.length != 2) {
            send(
                exchange,
                400,
                "Invalid request."
            );
            return;
        }

        String jobId = parts[0].trim();
        String code = parts[1];

        if (!JOB_ID_PATTERN.matcher(jobId).matches()) {
            send(
                exchange,
                400,
                "Invalid job ID."
            );
            return;
        }

        Path workDir = BASE_DIR.resolve(jobId)
            .normalize();

        if (!workDir.startsWith(
            BASE_DIR.normalize()
        )) {
            send(
                exchange,
                400,
                "Invalid workspace."
            );
            return;
        }

        try {
            Files.createDirectories(workDir);

            Path sourceFile =
                workDir.resolve("Main.java");

            Files.writeString(
                sourceFile,
                code,
                StandardCharsets.UTF_8
            );

            ByteArrayOutputStream output =
                new ByteArrayOutputStream();

            int result;

            synchronized (CompilerServer.class) {
                result = compiler.run(
                    null,
                    null,
                    output,
                    "-proc:none",
                    "-d",
                    workDir.toString(),
                    sourceFile.toString()
                );
            }

            String compilerOutput =
                output.toString(
                    StandardCharsets.UTF_8
                );

            if (result != 0) {
                send(
                    exchange,
                    400,
                    "COMPILE_ERROR\n" +
                    compilerOutput
                );
                return;
            }

            send(
                exchange,
                200,
                "COMPILED\n" +
                compilerOutput
            );

        } catch (Exception e) {
            send(
                exchange,
                500,
                "SERVER_ERROR\n" +
                e.getMessage()
            );
        }
    }

    private static void send(
        HttpExchange exchange,
        int status,
        String response
    ) throws IOException {

        byte[] data =
            response.getBytes(StandardCharsets.UTF_8);

        exchange.getResponseHeaders().set(
            "Content-Type",
            "text/plain; charset=UTF-8"
        );

        exchange.sendResponseHeaders(
            status,
            data.length
        );

        try (OutputStream output =
                 exchange.getResponseBody()) {

            output.write(data);
        }
    }
}