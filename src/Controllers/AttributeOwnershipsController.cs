using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/AttributeOwnerships")]
    public class AttributeOwnershipsController : Controller
    {
        private readonly PnPContext _context;

        public AttributeOwnershipsController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/AttributeOwnerships
        [HttpGet]
        public IEnumerable<AttributeOwnership> GetAttributeOwnership()
        {
            return _context.AttributeOwnership;
        }

        // GET: api/AttributeOwnerships/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetAttributeOwnership([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var attributeOwnership = await _context.AttributeOwnership.SingleOrDefaultAsync(m => m.Id == id);

            if (attributeOwnership == null)
            {
                return NotFound();
            }

            return Ok(attributeOwnership);
        }

        // PUT: api/AttributeOwnerships/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAttributeOwnership([FromRoute] int id, [FromBody] AttributeOwnership attributeOwnership)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != attributeOwnership.Id)
            {
                return BadRequest();
            }

            _context.Entry(attributeOwnership).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AttributeOwnershipExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/AttributeOwnerships
        [HttpPost]
        public async Task<IActionResult> PostAttributeOwnership([FromBody] AttributeOwnership attributeOwnership)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.AttributeOwnership.Add(attributeOwnership);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (AttributeOwnershipExists(attributeOwnership.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetAttributeOwnership", new { id = attributeOwnership.Id }, attributeOwnership);
        }

        // DELETE: api/AttributeOwnerships/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAttributeOwnership([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var attributeOwnership = await _context.AttributeOwnership.SingleOrDefaultAsync(m => m.Id == id);
            if (attributeOwnership == null)
            {
                return NotFound();
            }

            _context.AttributeOwnership.Remove(attributeOwnership);
            await _context.SaveChangesAsync();

            return Ok(attributeOwnership);
        }

        private bool AttributeOwnershipExists(int id)
        {
            return _context.AttributeOwnership.Any(e => e.Id == id);
        }
    }
}