Forked from https://github.com/samulman0688/docker-laravel-swarm

# 도커 설치

```bash
# Local Shell
$ curl -sSL https://get.docker.com/ | sh
$ apt-get install -y python-pip
$ pip install docker-compose
```

# 개발 환경

```bash
# Local Shell
# 시작
~/docker-swarm-exercise $ docker-compose -f docker-compose.dev.yml up --build -d

# 중지
~/docker-swarm-exercise $ docker-compose -f docker-compose.dev.yml down
```

# 원격 환경

```bash
# AWS Console
manager AMI : ami-7ffb2411 (docker php, ubuntu@PUBLIC_IP 로 로그인)
worker  AMI : ami-3a03dc54 (docker stable, docker@PUBLIC_IP 로 로그인)
```

```bash
# Remote Shell of Manager Node
~ $ sudo apt-get install -y python-pip && pip install docker-compose
~ $ docker login
```

```bash
# Remote Shell of Manager Node
~ $ git clone REPO.git
~ $ cd docker-swarm-exercise
~/docker-swarm-exercise $ cp .env.example .env
```

```bash
# Remote Shell of Manager Node
~/docker-swarm-exercise $ docker-compose -f docker-compose.live.yml build
~/docker-swarm-exercise $ docker-compose -f docker-compose.live.yml push
```

```bash
# Remote Shell of Manager Node

# Inbound TCP 8888, 2377 포트 오픈

~/docker-swarm-exercise $ docker swarm init 
# 출력내용을 다른 호스트에서 실행하여 swarm join

~/docker-swarm-exercise $ docker stack deploy -c docker-compose.live.yml --with-registry-auth laravel
```

```bash
# Remote Shell of Manager Node

# Inbound TCP 8080 포트 오픈

~/docker-swarm-exercise $ docker service create \
  --name=viz \
  --publish=8080:8080/tcp \
  --constraint=node.role==manager \
  --mount=type=bind,src=/var/run/docker.sock,dst=/var/run/docker.sock \
  dockersamples/visualizer
```

# 롤링 업데이트

```bash
# Remote Shell of Manager Node
~/docker-swarm-exercise $ docker-compose -f docker-compose.live.yml build php
~/docker-swarm-exercise $ docker-compose -f docker-compose.live.yml push php
~/docker-swarm-exercise $ docker service update --image {USER}/{IMAGE} --detach=false laravel_php
```
