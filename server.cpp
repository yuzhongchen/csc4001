#include<stdio.h>
#include<string.h>
#include<stdlib.h>
#include<unistd.h>
#include<arpa/inet.h>
#include<sys/socket.h>
#include<pthread.h>
#include<netinet/in.h>
#include<mutex>

int main(int argc,char** argv){
    int sock = socket(AF_INET,SOCK_STREAM,IPPROTO_TCP);
    struct sockaddr_in server_addr;
    memset(&memset,0,sizeof(server_addr));
    server_addr.sin_addr.s_addr = inet_addr("127.0.0.1");
    server_addr.sin_family = AF_INET;
    server_addr.sin_port = htons(1234);
    bind(sock,(struct sockaddr*)&server_addr,
    sizeof(server_addr));
    listen(sock,20);

    
}