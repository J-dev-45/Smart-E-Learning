FROM eclipse-temurin:21-jdk

WORKDIR /app/Compiler-Service

COPY Compiler-Service/ ./

RUN javac CompilerServer.java

CMD ["java", "CompilerServer"]