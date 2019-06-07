package net.betorcs

class CPanelClient(private val baseUrl: String, private val apiKey: String ) {

    private val restTemplate = RestTemplate()

    fun disableAccount(username: String, reason: String): Boolean {
        TODO("Not implemented")
    }

    fun enableAccount(username: String): Boolean {
        TODO("Not implemented")
    }

    fun findAccountByUsername(username: String): Map<String, Any> {
        TODO("Not implemented")
    }

}