# Vaquita on k8s

The following instruction are for developers that want to work on Vaquita and k8s.
The instructions are based on Rancher Desktop and should be portable on other environments.
In Rancher Desktop you can create a namespace and set it as your default context with kubectl. Here’s how:

- Create a namespace called 'dmpsee'

```bash
kubectl create namespace vaquita
```


- Set 'vaquita' as the default namespace for your current context

```bash
kubectl config set-context --current --namespace=vaquita
```


## Vaquita Storage: Vinti

Vinti is a filesystem-based storage server with an HTTP API.
It allows you to create folders, insert data, manage files, and retrieve content through simple JSON commands.
During the development you probably want to access to the files accessible by Vinti without access the container.
For this reason create a `tmp/storage` directory into the root of your cloned repository.

```bash
mkdir -p tmp/storage
```

The source code of Vinti is available in Github at [https://github.com/naranza/vinti](https://github.com/naranza/vinti).
After you cloned the repository enter on the root directory of the project and build the container.


```bash
docker build --no-cache -t vaquita-vinti:prod -f devops/container/Dockerfile.prod .
```

If you want to test it

```bash
docker run --rm \
  -v $(pwd):/app \
  -v $(pwd)/tmp/storage:/storage \
  -p 20201:20201 \
  vaquita-vinti:prod
```

You should be able to see the log like this

```bash
2025-09-08T10:12:27Z INFO Starting Vinti server 2025.6 on port 20201
```

Now apply the deployment

```bash
kubectl apply -f devops/k8s/dev/vaquita-vinti-deployment.yaml
```

Check pod status and logs


```bash
kubectl get pods -o wide
kubectl logs -f <pod-name>
```

You should see something like:

```bash
2025-09-08T10:12:27Z INFO Starting Vinti server 2025.6 on port 20201
```

Now install the Service

```bash
kubectl apply -f devops/k8s/dev/vaquita-vinti-service.yaml
```

## Vaquita API

For the API, and Dispatcher, you probably want to work on your code and see the changes into the k8s in real time.
To build the API container enter on the `devops/container/api` directory and execute

```bash
docker build --no-cache -t vaquita-api:dev -f Dockerfile.dev .
```


If you want to test it, go back to the root directory of Vaquita and run

```bash
docker run --rm \
  -v $(pwd):/opt/vaquita \
  -p 20443:443 \
  vaquita-api:dev
```

you shoudl see something like

```bash
2025-09-08 10:58:18,306 CRIT Supervisor is running as root.  Privileges were not dropped because no user is specified in the config file.  If you intend to run as root, you can set user=root in the config file to avoid this message.
2025-09-08 10:58:18,308 INFO supervisord started with pid 1
2025-09-08 10:58:19,312 INFO spawned: 'nginx' with pid 7
2025-09-08 10:58:19,315 INFO spawned: 'php-fpm' with pid 8
2025/09/08 10:58:19 [notice] 7#7: using the "epoll" event method
2025/09/08 10:58:19 [notice] 7#7: nginx/1.26.3
2025/09/08 10:58:19 [notice] 7#7: OS: Linux 6.6.96-0-virt
2025/09/08 10:58:19 [notice] 7#7: getrlimit(RLIMIT_NOFILE): 1048576:1048576
2025/09/08 10:58:19 [notice] 7#7: start worker processes
2025/09/08 10:58:19 [notice] 7#7: start worker process 9
2025/09/08 10:58:19 [notice] 7#7: start worker process 10
[08-Sep-2025 10:58:19] NOTICE: fpm is running, pid 8
[08-Sep-2025 10:58:19] NOTICE: ready to handle connections
2025-09-08 10:58:20,357 INFO success: nginx entered RUNNING state, process has stayed up for > than 1 seconds (startsecs)
2025-09-08 10:58:20,357 INFO success: php-fpm entered RUNNING state, process has stayed up for > than 1 seconds (startsecs)
```

Now apply the deployment

```bash
kubectl apply -f devops/k8s/dev/vaquita-api-deployment.yaml
```

Check pod status and logs


```bash
kubectl get pods -o wide
kubectl logs -f <pod-name>
```


```bash
kubectl apply -f devops/k8s/dev/vaquita-api-service.yaml
```


Check service status

```bash
kubectl get svc -o wide
```

Output should be like

```bash
NAME          TYPE       CLUSTER-IP      EXTERNAL-IP   PORT(S)                      AGE   SELECTOR
vaquita-api   NodePort   10.43.111.132   <none>        443:31785/TCP,80:31216/TCP   14s   app=vaquita-api
```
You should be able to see the Service and Pod via normal browser by go to the URL as below.
Amend the port number based on the output you had from `kubectl get svc -o wide`.

`https://localhost:31785/test.php`.


You should be able to see date and time like "2025-09-08 11:19:54".


You can see also the api test page at `https://vaquita-api.lan:31785/test.php`

## Vaquita Dispatch

To build the Dispatch container enter on the `devops/container/dispatch` directory and execute

```bash
docker build --no-cache -t vaquita-dispatch:dev -f Dockerfile.dev .
```


Now apply the deployment

```bash
kubectl apply -f devops/k8s/dev/vaquita-dispatch-deployment.yaml
```

Check pod status and logs


```bash
kubectl get pods -o wide
kubectl logs -f <pod-name>
```

SHould be note that Dispatch does not start automatically but the process must be executed manually.
To start a shell session inside the pod

```bash
kubectl exec -it <pod-name> -n vaquita -- /bin/bash
```
