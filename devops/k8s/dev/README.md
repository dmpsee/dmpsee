
Got it! In Rancher Desktop, which uses Kubernetes under the hood, you can create a namespace and set it as your default context with kubectl. Here’s how:

- Create a namespace called 'dmpsee'

```bash
kubectl create namespace dmpsee
```


- Set 'dmpsee' as the default namespace for your current context

```bash
kubectl config set-context --current --namespace=dmpsee
```


✅ After this, all kubectl commands you run will default to the dmpsee namespace unless you override it with -n <namespace>.




2. Build the vinti image for dev

```
docker build -t dmpsee-vinti:dev -f Dockerfile.dev .
```


3. Check that it’s built
docker images | grep vinti


You should see something like:

dmpsee-vinti   dev   abc1234def56   5 minutes ago   320MB

4. Run it directly (to test)
docker run --rm -it \
  -v $(pwd):/app \
  -v ~/tmp/storage-vinti:/storage \
  -p 20201:20201 \
  dmpsee-vinti:dev \
  /bin/bash